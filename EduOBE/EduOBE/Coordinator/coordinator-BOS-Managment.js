document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  const addBOSbutton = document.getElementById('addBOSBtn');
  const addBOSModalTitle = document.getElementById('addBOSModalLabel');
  const BOSmodalAddUpdateBtn = document.getElementById('BOS-modalAddUpdateBtn');
  const AddUpdateBOSForm = document.getElementById('addUpdateBOSForm')

  addBOSbutton.addEventListener('click', () => {
    addBOSModalTitle.innerHTML = 'ADD BOS';
    BOSmodalAddUpdateBtn.innerHTML = 'Add';
    AddUpdateBOSForm.action = `addBOSQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // reset input fields
  });

  const tableBOS = $('#BOS-dataTable').DataTable({
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
            '<div class="d-flex align-items-center justify-content-sm-evenly" col-2>' +
            '<button class="icon-button view-button" data-id="' +
            row.id +
            '"><img src="../icons/view.png" alt="View"></button>' +
            '<button class="icon-button edit-button" data-id="' +
            row.id +
            '"><img src="../icons/edit.svg" alt="Edit"></button>' +
            '<button class="icon-button delete-button" data-id="' +
            row.id +
            '"><img src="../icons/trash.svg" alt="Delete"></button></div>'
          );
        },
        width: '120px',
      },
    ],
  });

  //all keys in an object are listed here, either fixed or from database.
  var keys = [
    '',
    'code', 
    'name', 
    'career', 
    'scheme',
    'program', 
    'isOBE',
  ];

   // Add event linstner to the checkboxed when clicked.
   $('#BOS-dataTable tbody').on(
    'click',
    'input[type="checkbox"]',
    function () {
      let rowData = tableBOS.row($(this).closest('tr')).data();

      let convertedObject = {};
      for (let i = 0; i < keys.length; i++) {
        convertedObject[keys[i]] = rowData[i];
      }

      // console.log('convertedObject:', convertedObject);

      //to get the checkbox value that is it either checked or not.
      let checkboxValue = $(this)
        .closest('tr')
        .find('input[type="checkbox"]')
        .prop('checked');

      const url = `updateBOSCheckboxQuery.php?isOBE=${checkboxValue}&code=${convertedObject.code}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
      window.location.href = url;
      console.log('Checkbox Value:', checkboxValue);
    }
  );

  // Add event listener for view button in BOS DataTable
  $('#BOS-dataTable tbody').on('click', 'button.view-button', function () {
    let rowData = tableBOS.row($(this).closest('tr')).data();
    console.log('BOS-Table : ');
    console.log(rowData);
    // console.log('name = ' + rowData[2]);

    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }

    // localStorage.setItem('clickedBOS', JSON.stringify(convertedObject));
    // console.log(convertedObject);

    // Navigate to BOS-Details page.
    const url = `coordinator-BOS-Managment-bos-details.php?clickedBOSCode=${convertedObject.code}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
  });

  // Add event listener for edit button in BOS DataTable
  $('#BOS-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tableBOS.row($(this).closest('tr')).data();
    console.log('BOS-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addBOSModalTitle.innerHTML = 'Update BOS';
    BOSmodalAddUpdateBtn.innerHTML = 'Update';

    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }
    // console.log('converted object : ');
    // console.log(convertedObject)

    // Open addBOSModal
    $('#addBOSModal').modal('show');

    AddUpdateBOSForm.action = `updateBOSQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // Use the rowData to populate the fields in the modal
    $('#addBOSModal input[name="code"]').val(convertedObject.code);
    $('#addBOSModal input[name="name"]').val(convertedObject.name);
    $('#addBOSModal input[name="career"]').val(convertedObject.career);
    $('#addBOSModal input[name="scheme"]').val(convertedObject.scheme);
    $('#addBOSModal select[name="program"]').val(convertedObject.program);
    // Repeat for other fields
  });


  // ========================================== delete BOS
  let deleteRowData; // Variable to store the rowData for delete event.
  // Add event listener for delete button button in BOS DataTable
  $('#BOS-dataTable tbody').on('click', 'button.delete-button', function () {
    // let rowData = tableBOS.row($(this).closest('tr')).data();
    deleteRowData = tableBOS.row($(this).closest('tr')).data();
    console.log('BOS-Table : ');
    console.log(deleteRowData);

    // Open deleteBOSConfirmationModal
    $('#deleteBOSConfirmationModal').modal('show');
  });

  $('#confirmDeleteBOSBtn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deleteRowData);

    //deletion logic for deleteRowData
    var delete_selectedProgramCode = deleteRowData[1];
    console.log(delete_selectedProgramCode)
    const url = `deleteBOSQuery.php?code=${delete_selectedProgramCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#deleteBOSConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });
// =================================================================================================
  var data = jsonBOSData;
  const BOSdata = [];
  data.forEach((object) => {
    BOSdata.push(object);
    console.log(object);      
  });


var counter = 0;
    BOSdata.forEach((object) => {
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
      console.log("testing : ");
      console.log(object);


      counter++;
      if (object.isOBE === '1') {
        isCheckedInput.setAttribute('checked', 'checked');
        tableBOS.row.add([
          counter,
          object.code,
          object.name,
          object.career,
          object.scheme,
          object.program,
          checkboxContainer.outerHTML,
          '',
        ]);
      } else {
        isCheckedInput.removeAttribute('checked');
        tableBOS.row.add([
          counter,
          object.code,
          object.name,
          object.career,
          object.scheme,
          object.program,
          checkboxContainer.outerHTML,
          '',
        ]);
      }
    });


  tableBOS.draw();
  counter = 0;
  // =================================================================


 

  

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
