document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;
  // let clickedBOSData = localStorage.getItem('clickedBOS');
  // let clickedBOS = null;

  // // Check if the clickedBOSData is not null
  // if (clickedBOSData) {
  //   // Parse the retrieved data back into an object
  //   clickedBOS = JSON.parse(clickedBOSData);

  //   const BOSElements = document.querySelectorAll('.selected-BOS');
  //   BOSElements.forEach((BOS) => {
  //     BOS.innerHTML = clickedBOS.name;
  //   });
  // }

  const addCoursebutton = document.getElementById('addCourseBtn');
  const addCourseModalTitle = document.getElementById('addCourseModalLabel');
  const CoursemodalAddUpdateBtn = document.getElementById(
    'Course-modalAddUpdateBtn'
  );
  const BOSDetailsForm = document.getElementById(
    'BOSDetailsForm'
  );


  addCoursebutton.addEventListener('click', () => {
    addCourseModalTitle.innerHTML = 'Add BOS Course';
    CoursemodalAddUpdateBtn.innerHTML = 'Add';
    BOSDetailsForm.action = `addBOSDetailsQuery.php?clickdBOSCode=${BOSCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
  });

  const tableCourse = $('#Course-dataTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 15, 20, 30, 50],
    searching: true,
    info: true,
    scrollY: '250px',
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

  // //all keys in an object are listed here, either fixed or from database.
  // let keys = ['id', 'code', 'name', 'career', 'schemeType', 'isObeEnabled'];

  // // Add event listener for view button in Course DataTable
  // $('#Course-dataTable tbody').on('click', 'button.view-button', function () {
  //   let rowData = tableCourse.row($(this).closest('tr')).data();
  //   console.log('Course-Table : ');
  //   // console.log(rowData);
  //   // console.log('name = ' + rowData[2]);

  //   let convertedObject = {};
  //   for (let i = 0; i < keys.length; i++) {
  //     convertedObject[keys[i]] = rowData[i];
  //   }

  //   localStorage.setItem('clickedCourse', JSON.stringify(convertedObject));
  //   console.log(convertedObject);

  //   // Navigate to Course-Details page.
  //   // window.location.href =
  //   //   'coordinator-Student-Managment-batch-students-list.html';
  // });

  var keys = [
    '',
    'semester',
    'term', 
    'course_code',
    'course_type', 
    'credits',
    , 
  ];
  // Add event listener for edit button in Course DataTable
  $('#Course-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tableCourse.row($(this).closest('tr')).data();
    console.log('Course-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addCourseModalTitle.innerHTML = 'Update BOS Course';
    CoursemodalAddUpdateBtn.innerHTML = 'Update';


    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }
    // console.log('semester : ', convertedObject.semester);

    // Open addCourseModal
    $('#addCourseModal').modal('show');
    // BOSDetailsForm.action = 'updateBOSDetailsQuery.php';
    BOSDetailsForm.action = `updateBOSDetailsQuery.php?clickdBOSCode=${BOSCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`

    // Use the rowData to populate the fields in the modal
    $('#addCourseModal select[name="semester"]').val(convertedObject.semester);
    $('#addCourseModal select[name="term"]').val(convertedObject.term);
    $('#addCourseModal select[name="courseCode"]').val(convertedObject.course_code);
    $('#addCourseModal select[name="courseType"]').val(convertedObject.course_type);
    $('#addCourseModal input[name="credits"]').val(convertedObject.credits);
    
    // Repeat for other fields
  });

  let deleteRowData; // Variable to store the rowData for delete event.
  // Add event listener for delete button button in Course DataTable
  $('#Course-dataTable tbody').on('click', 'button.delete-button', function () {
    // let rowData = tableCourse.row($(this).closest('tr')).data();
    deleteRowData = tableCourse.row($(this).closest('tr')).data();
    console.log('Course-Table : ');
    console.log(deleteRowData);

    // Open deleteCourseConfirmationModal
    $('#deleteCourseConfirmationModal').modal('show');
  });

  $('#confirmDeleteCourseBtn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deleteRowData);

    //deletion logic for deleteRowData
    var delete_selectedProgramCode = deleteRowData[3];
    // console.log(delete_selectedProgramCode)

    // const url = `deleteBOSDetailQuery.php?code=${delete_selectedProgramCode}`;
    const url = `deleteBOSDetailQuery.php?code=${delete_selectedProgramCode}&clickdBOSCode=${BOSCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#deleteCourseConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });
// ===========================================================  draw table
  var data = jsonData;
  var BOSCode = BOSDatajsonData;
  // console.log('js BOS Code : ',boscode);

  const Coursedata = [];
  data.forEach((object) => {
    Coursedata.push(object);
    // console.log(object);      
  });
  console.log(Coursedata);


  const checkboxContainer = document.createElement('div');
  checkboxContainer.classList.add('d-flex', 'w-100', 'justify-content-center');

  const formCheckDiv = document.createElement('div');

  const isCheckedInput = document.createElement('input');
  isCheckedInput.classList.add('form-check-input');
  isCheckedInput.setAttribute('type', 'checkbox');
  isCheckedInput.setAttribute('id', 'isOBEenabled');

  const isCheckedLabel = document.createElement('label');
  isCheckedLabel.classList.add('form-check-label');
  isCheckedLabel.setAttribute('for', 'isOBEenabled');

  formCheckDiv.appendChild(isCheckedLabel);
  formCheckDiv.appendChild(isCheckedInput);
  checkboxContainer.appendChild(formCheckDiv);

  var counter=0;
  Coursedata.forEach((object) => {
    counter++;
    tableCourse.row.add([
      counter,
      object.semester,
      object.term,
      object.course_code,
      object.course_type,
      object.credits,
      '',
    ]);
  });

  tableCourse.draw();
  counter = 0;

  // //logic for selecting multiple options from Mapping PEO DropDown in add/update BOS modal.
  // const dropdown = document.getElementById('BOSDropdown');
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

// document.addEventListener('DOMContentLoaded', () => {
//   const addBOSbutton = document.getElementById('addBOSBtn');
//   const addBOSModalTitle = document.getElementById('addBOSModalLabel');
//   const BOSmodalAddUpdateBtn = document.getElementById('BOS-modalAddUpdateBtn');

//   addBOSbutton.addEventListener('click', () => {
//     addBOSModalTitle.innerHTML = 'ADD BOS';
//     BOSmodalAddUpdateBtn.innerHTML = 'Add';
//   });

//   const tableBOS = $('#BOS-dataTable').DataTable({
//     paging: true,
//     lengthMenu: [5, 10, 15, 20, 30, 50],
//     searching: true,
//     info: true,
//     scrollY: '250px',
//     scrollX: true,
//     language: {
//       lengthMenu: 'Show _MENU_ entries',
//       info: 'Showing _START_ to _END_ of _TOTAL_ entries',
//       search: 'Search:',
//       paginate: {
//         first: 'First',
//         last: 'Last',
//         next: 'Next',
//         previous: 'Previous',
//       },
//     },
//     columnDefs: [
//       {
//         targets: -1,
//         data: null,
//         orderable: false,
//         searchable: false,
//         render: function (data, type, row) {
//           return (
//             '<div class="d-flex align-items-center justify-content-sm-evenly"><button class="icon-button edit-button" data-id="' +
//             row.id +
//             '"><img src="../icons/edit.svg" alt="Edit"></button>' +
//             '<button class="icon-button delete-button" data-id="' +
//             row.id +
//             '"><img src="../icons/trash.svg" alt="Delete"></button></div>'
//           );
//         },
//       },
//     ],
//   });

//   // Add event listener for edit button in BOS DataTable
//   $('#BOS-dataTable tbody').on('click', 'button.edit-button', function () {
//     let rowData = tableBOS.row($(this).closest('tr')).data();
//     console.log('BOS-Table : ');
//     console.log(rowData);

//     // updating inner HTML content of modal title and action button.
//     addBOSModalTitle.innerHTML = 'Update BOS';
//     BOSmodalAddUpdateBtn.innerHTML = 'Update';

//     // Open addBOSModal
//     $('#addBOSModal').modal('show');

//     // Use the rowData to populate the fields in the modal
//     $('#addBOSModal input[name="name"]').val(rowData.name);
//     $('#addBOSModal input[name="age"]').val(rowData.age);
//     // Repeat for other fields
//   });

//   let deleteRowData; // Variable to store the rowData for delete event.
//   // Add event listener for delete button button in BOS DataTable
//   $('#BOS-dataTable tbody').on('click', 'button.delete-button', function () {
//     // let rowData = tableBOS.row($(this).closest('tr')).data();
//     deleteRowData = tableBOS.row($(this).closest('tr')).data();
//     console.log('BOS-Table : ');
//     console.log(deleteRowData);

//     // Open deleteBOSConfirmationModal
//     $('#deleteBOSConfirmationModal').modal('show');
//   });

//   $('#confirmDeleteBOSBtn').on('click', () => {
//     console.log('Deletion confirmed............');
//     console.log(deleteRowData);

//     //deletion logic for deleteRowData

//     // Reset the deleteRowData variable
//     deleteRowData = null;
//   });

//   // Cancel button event handler
//   $('#deleteBOSConfirmationModal').on('hidden.bs.modal', function () {
//     // Reset the deleteRowData, when the modal is closed/cancelled
//     deleteRowData = null;
//   });

//   const BOSdata = [
//     {
//       id: '1',
//       code: 'ABC123',
//       name: 'Object 1',
//       career: 'Career 1',
//       schemeType: 'Scheme Type 1',
//       isObeEnabled: true,
//     },
//     {
//       id: '2',
//       code: 'DEF456',
//       name: 'Object 2',
//       career: 'Career 2',
//       schemeType: 'Scheme Type 2',
//       isObeEnabled: false,
//     },
//     {
//       id: '3',
//       code: 'GHI789',
//       name: 'Object 3',
//       career: 'Career 3',
//       schemeType: 'Scheme Type 1',
//       isObeEnabled: true,
//     },
//     {
//       id: '4',
//       code: 'JKL012',
//       name: 'Object 4',
//       career: 'Career 4',
//       schemeType: 'Scheme Type 2',
//       isObeEnabled: false,
//     },
//     {
//       id: '5',
//       code: 'MNO345',
//       name: 'Object 5',
//       career: 'Career 5',
//       schemeType: 'Scheme Type 1',
//       isObeEnabled: true,
//     },
//     {
//       id: '6',
//       code: 'PQR678',
//       name: 'Object 6',
//       career: 'Career 6',
//       schemeType: 'Scheme Type 2',
//       isObeEnabled: false,
//     },
//     {
//       id: '7',
//       code: 'STU901',
//       name: 'Object 7',
//       career: 'Career 7',
//       schemeType: 'Scheme Type 1',
//       isObeEnabled: true,
//     },
//     {
//       id: '8',
//       code: 'VWX234',
//       name: 'Object 8',
//       career: 'Career 8',
//       schemeType: 'Scheme Type 2',
//       isObeEnabled: false,
//     },
//     {
//       id: '9',
//       code: 'YZA567',
//       name: 'Object 9',
//       career: 'Career 9',
//       schemeType: 'Scheme Type 1',
//       isObeEnabled: true,
//     },
//     {
//       id: '10',
//       code: 'BCD890',
//       name: 'Object 10',
//       career: 'Career 10',
//       schemeType: 'Scheme Type 2',
//       isObeEnabled: false,
//     },
//   ];

//   const checkboxContainer = document.createElement('div');
//   checkboxContainer.classList.add('d-flex', 'w-100', 'justify-content-center');

//   const formCheckDiv = document.createElement('div');

//   const isCheckedInput = document.createElement('input');
//   isCheckedInput.classList.add('form-check-input');
//   isCheckedInput.setAttribute('type', 'checkbox');
//   isCheckedInput.setAttribute('id', 'isOBEenabled');

//   const isCheckedLabel = document.createElement('label');
//   isCheckedLabel.classList.add('form-check-label');
//   isCheckedLabel.setAttribute('for', 'isOBEenabled');

//   formCheckDiv.appendChild(isCheckedLabel);
//   formCheckDiv.appendChild(isCheckedInput);
//   checkboxContainer.appendChild(formCheckDiv);

//   BOSdata.forEach((object) => {
//     tableBOS.row.add([
//       object.id,
//       object.code,
//       object.name,
//       object.career,
//       object.schemeType,
//       checkboxContainer.outerHTML,
//       '',
//     ]);
//   });

//   tableBOS.draw();

// });
