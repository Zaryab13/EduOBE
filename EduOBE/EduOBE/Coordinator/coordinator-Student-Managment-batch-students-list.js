document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;
  var batchName = batchNameJsonData;
  // Retrieve the clicked batch data from localStorage
  let clickedBatchData = localStorage.getItem('clickedBatch');

  // Check if the clickedBatchData is not null
  if (clickedBatchData) {
    // Parse the retrieved data back into an object
    let clickedBatch = JSON.parse(clickedBatchData);

    const batchElements = document.querySelectorAll('.std-batch');
    batchElements.forEach((batch) => {
      batch.innerHTML = clickedBatch.batchName;
    });
  }

  // construct the dataTable
  const addStudentButton = document.getElementById('addStudentBtn');
  const addStudentModalTitle = document.getElementById('addStudentModalLabel');
  const StudentModalAddUpdateBtn = document.getElementById('StudentModalAddUpdateBtn');
  const addUpdateStudentForm = document.getElementById("addUpdateStudentForm");

  addStudentButton.addEventListener('click', () => {
    addStudentModalTitle.innerHTML = 'Add Student';
    StudentModalAddUpdateBtn.innerHTML = 'Add';
    addUpdateStudentForm.action = `addStudentQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}&batchName=${batchName}`;
  });

  const tableStudents = $('#Student-dataTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    info: true,
    scrollY: '300px',
    scrollX: true,
    language: {
      lengthMenu: 'Show _MENU_ entries',
      info: 'Showing _START_ to _END_ of _TOTAL_ entries',
      search: 'Search:',
      paginate: {
        first: 'First',
        last: 'Last',
        next: 'Next',
        previous: 'Previous',
      },
    },
    columnDefs: [
      {
        targets: -1,
        data: null,
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          return (
            '<div class="d-flex align-items-center justify-content-sm-evenly"><button class="icon-button edit-button" data-id="' +
            row.id +
            '"><img src="../icons/edit.svg" alt="Edit"></button>' +
            '<button class="icon-button delete-button" data-id="' +
            row.id +
            '"><img src="../icons/trash.svg" alt="Delete"></button></div>'
          );
        },
      },
    ],
  });

  var keys = [
    'no',
    'Reg_No',
    'enrollNo',
    'name',
    'CNIC',
    'semester',
    'gender',
  ]

  // Add event listener for edit button in Student DataTable
  $('#Student-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tableStudents.row($(this).closest('tr')).data();
    console.log('Student-Table : ');
    console.log(rowData);

    //==================== conversion function
    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }


    let actualIndexInJsonData = StudentData.findIndex((object) => {
      return object.Reg_No === convertedObject.Reg_No;
    });

    let stdData = StudentData[actualIndexInJsonData];

    console.log('stdData object: ', stdData);


    // updating inner HTML content of modal title and action button.
    addStudentModalTitle.innerHTML = 'Update Student';
    StudentModalAddUpdateBtn.innerHTML = 'Update';

    // Open addStudentModallet rowData = tableStudents.row($(this).closest('tr')).data();
    $('#addStudentModal').modal('show');

    addUpdateStudentForm.action = `updateStudentsQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}&batchName=${batchName}`;

    // Use the rowData to populate the fields in the modal
    $('#addStudentModal input[name="Reg_No"]').val(stdData.Reg_No);
    $('#addStudentModal input[name="enrollNo"]').val(stdData.enrollNo);
    $('#addStudentModal input[name="name"]').val(stdData.name);
    $('#addStudentModal select[name="university"]').val(stdData.university);
    $('#addStudentModal select[name="department"]').val(stdData.department);
    $('#addStudentModal select[name="program"]').val(stdData.program);
    $('#addStudentModal select[name="batch"]').val(stdData.batch);
    $('#addStudentModal input[name="CNIC"]').val(stdData.CNIC);
    $('#addStudentModal input[name="semester"]').val(stdData.semester);
    $('#addStudentModal select[name="gender"]').val(stdData.gender);
    $('#addStudentModal input[name="fatherName"]').val(stdData.fatherName);
    $('#addStudentModal input[name="email"]').val(stdData.Email);
    $('#addStudentModal select[name="studyMode"]').val(stdData.studyMode);
    $('#addStudentModal select[name="MaritalStatus"]').val(stdData.MaritalStatus);
    $('#addStudentModal select[name="Religion"]').val(stdData.Religion);
    $('#addStudentModal input[name="DOB"]').val(stdData.DOB);
    $('#addStudentModal input[name="number"]').val(stdData.number);
    $('#addStudentModal input[name="permanentAddress"]').val(stdData.permanentAddress);
    $('#addStudentModal input[name="postalAddress"]').val(stdData.postalAddress);
    $('#addStudentModal input[name="currentCity"]').val(stdData.currentCity);
    $('#addStudentModal input[name="District"]').val(stdData.District);
    $('#addStudentModal input[name="province"]').val(stdData.province);
    $('#addStudentModal input[name="country"]').val(stdData.country);
    $('#addStudentModal select[name="HSSCType"]').val(stdData.HSSCType);
    $('#addStudentModal input[name="HSSCMarksPer"]').val(stdData.HSSCMarksPer);
    $('#addStudentModal input[name="AddApplicationNum"]').val(stdData.AddApplicationNum);
    $('#addStudentModal input[name="AdmisionDate"]').val(stdData.AdmisionDate);
    $('#addStudentModal select[name="admisionCategory"]').val(stdData.admisionCategory);
    $('#addStudentModal select[name="admissionType"]').val(stdData.admissionType);
    $('#addStudentModal input[name="Quota"]').val(stdData.Quota);
    $('#addStudentModal input[name="extraInfo"]').val(stdData.extraInfo);
    // Repeat for other fields
  });

  let deleteRowData;
  $('#Student-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      // let rowData = tableBatch.row($(this).closest('tr')).data();
      deleteRowData = tableStudents.row($(this).closest('tr')).data();
      console.log('Batch-Table : ');
      console.log(deleteRowData);

      // Open deleteBatchConfirmationModal
      $('#deleteStudentConfirmationModal').modal('show');
    }
  );

  $('#confirmDeleteStudentBtn').on('click', () => {
    // console.log('Deletion confirmed............');
    // console.log(deleteRowData);

    //deletion logic for deleteRowData
    var selected_reg_num = deleteRowData[1];
    // console.log(selected_reg_num)
    const url = `deleteStudentsQuery.php?Reg_No=${selected_reg_num}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}&batchName=${batchName}`;
    window.location.href = url;
    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#deleteStudentConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });

  var data = jsonStdData;
  const StudentData = [];
  var counter = 0;
  data.forEach((object) => {
    StudentData.push(object);      
  });



  StudentData.forEach((object) => {
    counter++;
    tableStudents.row.add([
      counter,
      object.Reg_No,
      object.enrollNo,
      object.name,
      object.CNIC,
      object.semester,
      object.gender,
      '',
    ]);
  });

  tableStudents.draw();
  counter = 0;
});
