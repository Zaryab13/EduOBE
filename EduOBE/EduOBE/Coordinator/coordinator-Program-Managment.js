document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  const addProgramButton = document.getElementById('addProgramBtn');
  const addProgramModalTitle = document.getElementById('addProgramModalLabel');
  const programModalAddUpdateBtn = document.getElementById(
    'programModalAddUpdateBtn'
  );
  const programAddUpdateForm = document.getElementById('programAddUpdateForm');

  addProgramButton.addEventListener('click', () => {
    addProgramModalTitle.innerHTML = 'Add Program';
    programModalAddUpdateBtn.innerHTML = 'Add';
    programAddUpdateForm.action = `addProgramQuery.php?userName=${username}`;

    $('#addProgramModal input[name="programCode"]').val('');
    $('#addProgramModal input[name="programName"]').val('');
    $('#addProgramModal input[name="type"]').val('');
    $('#addProgramModal input[name="passingMarksPer"]').val('');
    $('#addProgramModal input[name="numOfSemester"]').val('');
    $('#addProgramModal input[name="progLevel"]').val('');
    $('#addProgramModal input[name="assesMethod"]').val('');
    $('#addProgramModal input[name="learningType"]').val('');
  });

  const tablePrograms = $('#program-dataTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    info: true,
    scrollY: '400px',
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
    'program_code',
    'program_name',
    'type',
    'number_of_semester',
    'program_level',
    'assessment_method',
    'passing_marks_per',
    'learning_type',
  ]

  // Add event listener for edit button in Program DataTable
  $('#program-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tablePrograms.row($(this).closest('tr')).data();
    console.log('Program-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addProgramModalTitle.innerHTML = 'Update Program';
    programModalAddUpdateBtn.innerHTML = 'Update';

    // Open addProgramModallet rowData = tablePrograms.row($(this).closest('tr')).data();
    $('#addProgramModal').modal('show');

    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }
    // console.log(convertedObject);

    programAddUpdateForm.action = `updateProgramQuery.php?userName=${username}`;
    
    // Use the rowData to populate the fields in the modal
    $('#addProgramModal input[name="programCode"]').val(convertedObject.program_code);
    $('#addProgramModal input[name="programName"]').val(convertedObject.program_name);
    $('#addProgramModal select[name="type"]').val(convertedObject.type);
    $('#addProgramModal input[name="passingMarksPer"]').val(convertedObject.passing_marks_per);
    $('#addProgramModal select[name="numOfSemester"]').val(convertedObject.number_of_semester);
    $('#addProgramModal select[name="progLevel"]').val(convertedObject.program_level);
    $('#addProgramModal select[name="assesMethod"]').val(convertedObject.assessment_method);
    $('#addProgramModal select[name="learningType"]').val(convertedObject.learning_type);
    });

  let deleteRowData;
  $('#program-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      // let rowData = tableBatch.row($(this).closest('tr')).data();
      deleteRowData = tablePrograms.row($(this).closest('tr')).data();
      console.log('Batch-Table : ');
      console.log(deleteRowData);

      // Open deleteBatchConfirmationModal
      $('#deleteProgramConfirmationModal').modal('show');
    }
  );

  $('#confirmDeleteProgramBtn').on('click', () => {
    // console.log('Deletion confirmed............');
    // console.log(deleteRowData);
    // let convertedObject = {};
    // for (let i = 0; i < keys.length; i++) {
    //   convertedObject[keys[i]] = deleteRowData[i];
    // }
    var delete_selectedProgramCode = deleteRowData[1];
    console.log(delete_selectedProgramCode)
    const url = `deleteProgramQuery.php?programCode=${delete_selectedProgramCode}&userName=${username}`;
        window.location.href = url;

    //deletion logic for deleteRowData

    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // ================================  Cancel button event handler
  $('#deleteProgramConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });


  // ===================================================================== Upload data from php to table
  var data = jsonData;
  const programData = [];
  // console.log('data:',data);
  

  data.forEach((object, index) => {
    programData.push(object);      
  });
  // console.log('program data:',programData);
  var counter=0;

  if (programData.length > 0){
    programData.forEach((object) => {
      counter++;
      tablePrograms.row.add([
        counter,
        object.program_code,
        object.program_name,
        object.type,
        object.number_of_semester,
        object.program_level,
        object.assessment_method,
        object.passing_marks_per,
        object.learning_type,
        '',
      ]);
    });
  
  }
  tablePrograms.draw();

  counter = 0;

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
});
