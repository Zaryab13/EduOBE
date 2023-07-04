document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  let deleteClassroomRowData;
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%%%%%%%%%% Classrooms Modal %%%%%%%%%%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  const addClassroomsbutton = document.getElementById('addClassroomsBtn');

  const addClassroomsModalTitle = document.getElementById('addClassroomsModalLabel');
  const ClassroomsmodalAddUpdateBtn = document.getElementById('Classrooms-modalAddUpdateBtn');
  const addUpdateClassRoomForm = document.getElementById("addUpdateClassRoomForm");

  addClassroomsbutton.addEventListener('click', () => {
    addClassroomsModalTitle.innerHTML = 'Add Classroom';
    ClassroomsmodalAddUpdateBtn.innerHTML = 'Add';
    addUpdateClassRoomForm.action = `addClassRoomQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
  });

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%% Active Classrooms Table %%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  const tableActiveClassrooms = $('#ActiveClassrooms-dataTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    info: true,
    scrollY: '280px',
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
  var activekeys = [
    '',
    'classroom_id', 
    'batch_id', 
    'semester',
    'course_id',    
    'term',
    'teacher_name', 
    'status',
  ];
  // Add event linstner to the checkboxed when clicked.
  $('#ActiveClassrooms-dataTable tbody').on(
    'click',
    'input[type="checkbox"]',
    function () {
      // Get the data for the row
      let rowIndex = $(this).closest('tr').index();

      let rowData = tableActiveClassrooms.row(rowIndex).data();
      console.log('Row Index:', rowIndex);
      console.log('Row Data:', rowData);

      // Get the row index
      
      let convertedObject = {};
      for (let i = 0; i < activekeys.length; i++) {
        convertedObject[activekeys[i]] = rowData[i];
      }
      // console.log('convertedObject:', convertedObject);


      //to get the checkbox value that is it either checked or not.
      let checkboxValue = $(this)
        .closest('tr')
        .find('input[type="checkbox"]')
        .prop('checked');

      const url = `updateclassroomCheckboxQuery.php?isActive=${checkboxValue}&classroomId=${convertedObject.classroom_id}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
      window.location.href = url;
      console.log('Checkbox Value:', checkboxValue);
    }
  );

  // Add event listener for edit button in ActiveClassrooms DataTable
  $('#ActiveClassrooms-dataTable tbody').on(
    'click',
    'button.edit-button',
    function () {
      let rowData = tableActiveClassrooms.row($(this).closest('tr')).data();
      console.log('PEO-Table : ');
      console.log(rowData);

      //to get the checkbox value that is it either checked or not.
      // let checkboxValue = $(this)
      //   .closest('tr')
      //   .find('input[type="checkbox"]')
      //   .prop('checked');
      // console.log('Checkbox Value:', checkboxValue);

      // updating inner HTML content of modal title and action button.
      addClassroomsModalTitle.innerHTML = 'Update Classroom';
      ClassroomsmodalAddUpdateBtn.innerHTML = 'Update';

      let convertedObject = {};
      for (let i = 0; i < activekeys.length; i++) {
        convertedObject[activekeys[i]] = rowData[i];
      }
      // Open addClassroomModal
      $('#addClassroomModal').modal('show');
      addUpdateClassRoomForm.action = `updateClassroomQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

      // $('#addClassroomModal select[name="classroomId"]').val(convertedObject.batch_id);
      $('#addClassroomModal select[name="batchId"]').val(convertedObject.batch_id);
      $('#addClassroomModal select[name="courseId"]').val(convertedObject.course_id);
      $('#addClassroomModal select[name="term"]').val(convertedObject.term);
      $('#addClassroomModal select[name="teacherName"]').val(convertedObject.teacher_name);
      $('#addClassroomModal select[name="semester"]').val(convertedObject.semester);

      // Use the rowData to populate the fields in the modal
      // $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
      // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
      // Repeat for other fields
    }
  );

  // Add event listener for delete button in ActiveClassrooms DataTable
  $('#ActiveClassrooms-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteClassroomRowData = tableActiveClassrooms
        .row($(this).closest('tr'))
        .data();
      console.log('Active Classroom-Table : ');
      // console.log(deleteClassroomRowData);

      // Open deleteBatchConfirmationModal
      $('#deleteClassroomConfirmationModal').modal('show');
    }
  );

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%% Previous Classrooms Table %%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  const tablePreviousClassrooms = $('#PreviousClassrooms-dataTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
    searching: true,
    info: true,
    scrollY: '280px',
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

  var unActivekeys = [
    '',
    'classroom_id', 
    'batch_id', 
    'semester',
    'course_id',    
    'term',
    'teacher_name', 
    'isOBE',
  ];

  // Add event linstner to the checkboxed when clicked.
  $('#PreviousClassrooms-dataTable tbody').on(
    'click',
    'input[type="checkbox"]',
    function () {
      // Get the row index
      let rowIndex = $(this).closest('tr').index();

      // Get the data for the row
      let rowData = tablePreviousClassrooms.row(rowIndex).data();
      console.log('Row Index:', rowIndex);
      console.log('Row Data:', rowData);

      let convertedObject = {};
      for (let i = 0; i < unActivekeys.length; i++) {
        convertedObject[unActivekeys[i]] = rowData[i];
      }
      

      //to get the checkbox value that is it either checked or not.
      let checkboxValue = $(this)
        .closest('tr')
        .find('input[type="checkbox"]')
        .prop('checked');
      console.log('Checkbox Value:', checkboxValue);

      const url = `updateclassroomCheckboxQuery.php?isActive=${checkboxValue}&classroomId=${convertedObject.classroom_id}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
      window.location.href = url;
      console.log('Checkbox Value:', checkboxValue);
      
    }
  );



  // Add event listener for edit button in PreviousClassrooms DataTable
  $('#PreviousClassrooms-dataTable tbody').on(
    'click',
    'button.edit-button',
    function () {
      let rowData = tablePreviousClassrooms.row($(this).closest('tr')).data();
      // console.log('classroom-Table : ');
      // console.log(rowData);

      //to get the checkbox value that is it either checked or not.
      // let checkboxValue = $(this)
      //   .closest('tr')
      //   .find('input[type="checkbox"]')
      //   .prop('checked');
      // console.log('Checkbox Value:', checkboxValue);
      
      
      // updating inner HTML content of modal title and action button.
      addClassroomsModalTitle.innerHTML = 'Update Classroom';
      ClassroomsmodalAddUpdateBtn.innerHTML = 'Update';

      let convertedObject = {};
      for (let i = 0; i < unActivekeys.length; i++) {
        convertedObject[unActivekeys[i]] = rowData[i];
      }
      console.log("convertedObject : ");
      console.log(convertedObject);



      // const url = `updateclassroomCheckboxQuery.php?isActive=${checkboxValue}&batch_id=${convertedObject.batch_id}`;
      // window.location.href = url;
      // console.log('Checkbox Value:', checkboxValue);



      // Open addClassroomModal
      $('#addClassroomModal').modal('show');
      addUpdateClassRoomForm.action = `updateClassroomQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;


      // Use the rowData to populate the fields in the modal
      // $('#addClassroomModal select[name=""]').val(convertedObject.batch_id);
      $('#addClassroomModal select[name="batchId"]').val(convertedObject.batch_id);
      $('#addClassroomModal select[name="courseId"]').val(convertedObject.course_id);
      $('#addClassroomModal select[name="term"]').val(convertedObject.term);
      $('#addClassroomModal select[name="teacherName"]').val(convertedObject.teacher_name);
      $('#addClassroomModal select[name="semester"]').val(convertedObject.semester);

      // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
      // Repeat for other fields
    }
  );

  // Add event listener for delete button in PreviousClassrooms DataTable
  $('#PreviousClassrooms-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteClassroomRowData = tablePreviousClassrooms
        .row($(this).closest('tr'))
        .data();
      console.log('Previous Classroom-Table : ');
      console.log(deleteClassroomRowData);

      // Open deleteBatchConfirmationModal
      $('#deleteClassroomConfirmationModal').modal('show');
    }
  );

  // %%%%%%%%%%%%%%% End Tables %%%%%%%%%%%%%%%%%%%%%

  // %%%%%%%%%%% Data delete Modal logic %%%%%%%%%%

  $('#confirmDeleteClassroomBtn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deleteClassroomRowData);

    //deletion logic for deleteClassRoomRowData
    var delete_selectedclassroomCode = deleteClassroomRowData[1];
    console.log(delete_selectedclassroomCode)
    const url = `deleteClassroomQuery.php?batchId=${delete_selectedclassroomCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deletePEORowData variable
    deleteClassroomRowData = null;
  });

  // Cancel button event handler
  $('#deleteClassroomConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deletePEORowData, when the modal is closed/cancelled
    deleteClassroomRowData = null;
  });

  // %%%%%%%%% END of Data delete Modal logic %%%%%%%%%%

  // Classrooms Data
  var data = jsonData;
  const Classroomsdata = [];
  data.forEach((object) => {
    Classroomsdata.push(object);
    console.log(object);      
  });

var counter=0;
  Classroomsdata.forEach((object) => {
    const checkboxContainer = document.createElement('div');
    checkboxContainer.classList.add(
      'd-flex',
      'w-100',
      'justify-content-center'
    );

    const formCheckDiv = document.createElement('div');

    const isCheckedInput = document.createElement('input');
    isCheckedInput.classList.add('form-check-input');
    isCheckedInput.setAttribute('type', 'checkbox');
    isCheckedInput.setAttribute('id', 'isOBEenabled');

    const isCheckedLabel = document.createElement('label');
    isCheckedLabel.classList.add('form-check-label');
    isCheckedLabel.setAttribute('for', 'isActive');

    formCheckDiv.appendChild(isCheckedLabel);
    formCheckDiv.appendChild(isCheckedInput);
    checkboxContainer.appendChild(formCheckDiv);

    counter++;
    if (object.status === '1') {
      isCheckedInput.setAttribute('checked', 'checked');
      tableActiveClassrooms.row.add([
        counter,
        object.classroom_id,
        object.batch_id,
        object.semester, 
        object.course_id,
        object.term,
        object.teacher_name,
        checkboxContainer.outerHTML,
        '',
      ]);
    } else {
      isCheckedInput.removeAttribute('checked');
      tablePreviousClassrooms.row.add([
        counter,
        object.classroom_id,
        object.batch_id,
        object.semester,        
        object.course_id,
        object.term,
        object.teacher_name,
        checkboxContainer.outerHTML,
        '',
      ]);
    }
  });

  tableActiveClassrooms.draw();
  tablePreviousClassrooms.draw();
  counter = 0;

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  // //logic for selecting multiple options from Mapping PEO DropDown in add/update PLO modal.
  // const dropdown = document.getElementById('ploDropdown');
  // const tagContainer = document.querySelector('.tag-container');
  // const selectedOptions = [];

  // dropdown.addEventListener('change', function () {
  //   const selectedOption = dropdown.value;

  //   if (selectedOption !== '') {
  //     const selectedText = dropdown.options[dropdown.selectedIndex].text;

  //     const tag = document.createElement('div');
  //     tag.classList.add('tag');
  //     tag.textContent = selectedText;

  //     const removeBtn = document.createElement('span');
  //     removeBtn.classList.add('tag-remove');
  //     removeBtn.innerHTML = '&times;';
  //     removeBtn.addEventListener('click', function () {
  //       tagContainer.removeChild(tag);
  //       const optionIndex = selectedOptions.indexOf(selectedOption);
  //       if (optionIndex !== -1) {
  //         selectedOptions.splice(optionIndex, 1);
  //         enableOption(selectedOption);
  //       }
  //     });

  //     tag.appendChild(removeBtn);
  //     tagContainer.appendChild(tag);

  //     selectedOptions.push(selectedOption);
  //     disableOption(selectedOption);
  //     dropdown.selectedIndex = 0;
  //   }
  // });

  // function disableOption(optionValue) {
  //   for (let i = 0; i < dropdown.options.length; i++) {
  //     if (dropdown.options[i].value === optionValue) {
  //       dropdown.options[i].disabled = true;
  //       break;
  //     }
  //   }
  // }

  // function enableOption(optionValue) {
  //   for (let i = 0; i < dropdown.options.length; i++) {
  //     if (dropdown.options[i].value === optionValue) {
  //       dropdown.options[i].disabled = false;
  //       break;
  //     }
  //   }
  // }

  // // Dynimaically adding 'admin' as logedIn user.
  // const userNameLinkElement = document.getElementById('user-name-link');
  // const userNameTextElement = document.getElementsByClassName('user-name-text');

  // userNameLinkElement.textContent = 'AbdurRehman';
  // userNameTextElement[0].textContent = 'AbdurRehman';

  // //Number of Total Departments
  // const numberOfTotalDepartments =
  //   document.getElementsByClassName('total-departments');
  // numberOfTotalDepartments[0].textContent = data.length;
});




