document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  const addPEObutton = document.getElementById('addPEOBtn');
  const addPLObutton = document.getElementById('addPLOBtn');
  const addPEOModalTitle = document.getElementById('addPEOModalLabel');
  const addPLOModalTitle = document.getElementById('addPLOModalLabel');
  const PEOmodalAddUpdateBtn = document.getElementById('PEO-modalAddUpdateBtn');
  const PLOmodalAddUpdateBtn = document.getElementById('PLO-modalAddUpdateBtn');
  const addUpdatePEOForm = document.getElementById('addUpdatePEOForm');
  const addUpdatePLOForm = document.getElementById('addUpdatePLOForm');

  addPEObutton.addEventListener('click', () => {
    addPEOModalTitle.innerHTML = 'Add PEO';
    PEOmodalAddUpdateBtn.innerHTML = 'Add';
    addUpdatePEOForm.action = `addPEOQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // reset input fields
    $('#addPEOModal input[name="peoCode"]').val('');
    $('#addPEOModal input[name="peoName"]').val('');
    $('#addPEOModal input[name="peoProgram"]').val('');
    $('#addPEOModal textarea[name="peoDescription"]').val('');
  });

  addPLObutton.addEventListener('click', () => {
    addPLOModalTitle.innerHTML = 'ADD PLO';
    PLOmodalAddUpdateBtn.innerHTML = 'Add';
    addUpdatePLOForm.action = `addPLOQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // reset input fields
    $('#addPLOModal input[name="PLOCode"]').val('');
    $('#addPLOModal input[name="PLOName"]').val('');
    $('#addPLOModal textarea[name="PLODescription"]').val('');
    $('#addPLOModal input[name="PLOKpi"]').val('');
    $('#addPLOModal').on('hidden.bs.modal', function () {
      $(this).find('input[name^="PLOMapping"]').prop('checked', false);
    });
  });

  const tablePEO = $('#PEO-dataTable').DataTable({
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

  var PEOkeys = [
    'no',
    'PEO_code',
    'name',
    'description',
    'ref_program_code',
  ]
  
  // Add event listener for edit button in PEO DataTable
  $('#PEO-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tablePEO.row($(this).closest('tr')).data();
    console.log('PEO-Table : ');
    console.log(rowData);
    
    //==================== conversion function
    let convertedObject = {};
    for (let i = 0; i < PEOkeys.length; i++) {
      convertedObject[PEOkeys[i]] = rowData[i];
    }

    console.log('converted object: ', convertedObject)

    // updating inner HTML content of modal title and action button.
    addPEOModalTitle.innerHTML = 'Update PEO';
    PEOmodalAddUpdateBtn.innerHTML = 'Update';

    // Open addPEOModal
    $('#addPEOModal').modal('show');

    addUpdatePEOForm.action = `updatePEOQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    
    // Use the rowData to populate the fields in the modal
    // console.log('PEO Code: ', convertedObject.PEO_code);
    // console.log('program code: ', convertedObject.ref_program_code);
    $('#addPEOModal input[name="peoCode"]').val(convertedObject.PEO_code);
    $('#addPEOModal input[name="peoName"]').val(convertedObject.name);
    $('#addPEOModal input[name="peoProgram"]').val(convertedObject.ref_program_code);
    $('#addPEOModal textarea[name="peoDescription"]').val(convertedObject.description);
  });

  // =================================  delete PEo
  let deletePEORowData;
  $('#PEO-dataTable tbody').on('click', 'button.delete-button', function () {
    // let rowData = tableBatch.row($(this).closest('tr')).data();
    deletePEORowData = tablePEO.row($(this).closest('tr')).data();
    console.log('PEO-Table : ');
    console.log(deletePEORowData);

    // Open deleteBatchConfirmationModal
    $('#deletePEOConfirmationModal').modal('show');
  });

  $('#confirmDeletePEOBtn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deletePEORowData);

    //deletion logic for deletePEORowData
    var delete_selectedProgramCode = deletePEORowData[1];
    console.log(delete_selectedProgramCode)
    const url = `deletePEOQuery.php?peoCode=${delete_selectedProgramCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deletePEORowData variable
    deletePEORowData = null;
  });

  // Cancel button event handler
  $('#deletePEOConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deletePEORowData, when the modal is closed/cancelled
    deletePEORowData = null;
  });

  // ===================================================================== Upload data from php to table
  var data = jsonPEOData;
  const PEOdata = [];


  data.forEach((object) => {
    PEOdata.push(object);      
  });


  var counter=0;
  if (PEOdata.length > 0){
    PEOdata.forEach((object) => {
      counter++;
      tablePEO.row.add([
        counter,
        object.PEO_code,
        object.name,
        object.description,
        object.ref_program_code,
        '',
      ]);
    });
  
  }
  tablePEO.draw();
  counter = 0;

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  const tablePLO = $('#PLO-dataTable').DataTable({
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


  var PLOkeys = [
    'no',
    'PLO_code',
    'name',
    'description',
    'KPI',
    'mapp_to_peos',
    
  ]

  // Add event listener for edit button in PLO DataTable
  $('#PLO-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowDataPLO = tablePLO.row($(this).closest('tr')).data();
    console.log('PLO-Table : ');
    console.log(rowDataPLO);


    let convertedObject = {};
    for (let i = 0; i < PLOkeys.length; i++) {
      convertedObject[PLOkeys[i]] = rowDataPLO[i];
    }

    
    // updating inner HTML content of modal title and action button.
    addPLOModalTitle.innerHTML = 'Update PLO';
    PLOmodalAddUpdateBtn.innerHTML = 'Update';

    // Open addPLOModal
    $('#addPLOModal').modal('show');

    addUpdatePLOForm.action = `updatePLOQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // Use the rowData to populate the fields in the modal
    $('#addPLOModal input[name="PLOCode"]').val(convertedObject.PLO_code);
    $('#addPLOModal input[name="PLOName"]').val(convertedObject.name);
    $('#addPLOModal textarea[name="PLODescription"]').val(convertedObject.description);
    $('#addPLOModal input[name="PLOKpi"]').val(convertedObject.KPI);

    var checkboxValues = convertedObject.mapp_to_peos;
    var array = checkboxValues.replace(/[\[\]']+/g, '').split(' ');
    console.log(array);


    array.forEach(function (value) {
      console.log('array inside value:' , value);
      $(`#addPLOModal input[name="PLOMapping[${value}]"]`).prop('checked', true);
      
      $('#addPLOModal').on('hidden.bs.modal', function () {
        $(`#addPLOModal input[name="PLOMapping[${value}]"]`).prop('checked', false);
      });
    });
    // for (var i = 0; i < array.length; i++) {
    //   console.log(array[i]);
    //   $(`#addPLOModal input[name="PLOMapping[${array}]"]`).prop('checked',true);
    
    //   $('#addPLOModal').on('hidden.bs.modal', function () {
    //     // Reset the deletePLORowData, when the modal is closed/cancelled
    //     $(`#addPLOModal input[name="PLOMapping[${array}]"]`).prop('checked',false);
    //   });
    // }

    // $(`#addPLOModal input[name="PLOMapping[${convertedObject.mapp_to_peos}]"]`).prop('checked',true);
    
    // $('#addPLOModal').on('hidden.bs.modal', function () {
    //   // Reset the deletePLORowData, when the modal is closed/cancelled
    //   $(`#addPLOModal input[name="PLOMapping[${convertedObject.mapp_to_peos}]"]`).prop('checked',false);
    // });

    
    // Repeat for other fields
  });

  let deletePLORowData;
  $('#PLO-dataTable tbody').on('click', 'button.delete-button', function () {
    // let rowData = tableBatch.row($(this).closest('tr')).data();
    deletePLORowData = tablePLO.row($(this).closest('tr')).data();
    console.log('PLO-Table : ');
    console.log(deletePLORowData);

    // Open deleteBatchConfirmationModal
    $('#deletePLOConfirmationModal').modal('show');
  });


  $('#confirmDeletePLOBtn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deletePLORowData);

    //deletion logic for deletePLORowData
    var delete_selectedPLOCode = deletePLORowData[1];
    console.log(delete_selectedPLOCode)
    const url = `deletePLOQuery.php?PLOCode=${delete_selectedPLOCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deletePLORowData variable
    deletePLORowData = null;
  });

  // Cancel button event handler
  $('#deletePLOConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deletePLORowData, when the modal is closed/cancelled
    deletePLORowData = null;
  });



  var DataPLO = jsonPLOData;
  const PLOdata = [];

  DataPLO.forEach((object) => {
    PLOdata.push(object);      
  });

  var counter=0;

  if (PLOdata.length > 0){
    PLOdata.forEach((object) => {
      counter++;
      tablePLO.row.add([
        counter,
        object.PLO_code,
        object.name,
        object.description,
        object.KPI,
        object.mapp_to_peos,
        '',
      ]);
    });
  
  }
  tablePLO.draw();
  counter = 0;


  //logic for selecting multiple options from Mapping PEO DropDown in add/update PLO modal.
  const dropdown = document.getElementById('ploDropdown');
  const tagContainer = document.querySelector('.tag-container');
  const selectedOptions = [];

  dropdown.addEventListener('change', function () {
    const selectedOption = dropdown.value;

    if (selectedOption !== '') {
      const selectedText = dropdown.options[dropdown.selectedIndex].text;

      const tag = document.createElement('div');
      tag.classList.add('tag');
      tag.textContent = selectedText;

      const removeBtn = document.createElement('span');
      removeBtn.classList.add('tag-remove');
      removeBtn.innerHTML = '&times;';
      removeBtn.addEventListener('click', function () {
        tagContainer.removeChild(tag);
        const optionIndex = selectedOptions.indexOf(selectedOption);
        if (optionIndex !== -1) {
          selectedOptions.splice(optionIndex, 1);
          enableOption(selectedOption);
        }
      });

      tag.appendChild(removeBtn);
      tagContainer.appendChild(tag);

      selectedOptions.push(selectedOption);
      disableOption(selectedOption);
      dropdown.selectedIndex = 0;

      
    }
  });

  function disableOption(optionValue) {
    for (let i = 0; i < dropdown.options.length; i++) {
      if (dropdown.options[i].value === optionValue) {
        dropdown.options[i].disabled = true;
        break;
      }
    }
    // Send selectedOptions to the same PHP file
    sendSelectedOptions(selectedOptions);
  }

  function enableOption(optionValue) {
    for (let i = 0; i < dropdown.options.length; i++) {
      if (dropdown.options[i].value === optionValue) {
        dropdown.options[i].disabled = false;
        break;
      }
    }
    // Send selectedOptions to the same PHP file
    sendSelectedOptions(selectedOptions);
  }


  function sendSelectedOptions() {
    const xhr = new XMLHttpRequest();
    const url = window.location.href; // Current page URL
  
    // xhr.open('POST', url, true);
    xhr.open("GET", url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response from the server
        const response = xhr.responseText;
        console.log(response)
      }
    };
  
    const params = 'selectedOptions=' + encodeURIComponent(JSON.stringify(selectedOptions));
    xhr.send(params);
  }



  // function sendSelectedOptions(options) {
  //   const xhr = new XMLHttpRequest();
  //   const url = 'coordinator-PEO-PLO-Managment.php';

  //   // Add a timestamp parameter to bypass caching
  //   const timestamp = new Date().getTime();
  //   const urlWithTimestamp = url + '?timestamp=' + timestamp;
  //   xhr.open('POST', urlWithTimestamp, true);
  
  //   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  //   xhr.onreadystatechange = function () {
  //     if (xhr.readyState === 4 && xhr.status === 200) {
  //       // Handle the response from the server
  //       const response = xhr.responseText;
  //       console.log(response.length);
  //     }
  //   };
  
  //   const params = 'selectedOptions=' + encodeURIComponent(JSON.stringify(options));
  //   xhr.send(params);
  // }

  // function sendSelectedOptions(options) {
  //   const xhr = new XMLHttpRequest();
  //   const url = 'coordinator-PEO-PLO-Managment.php';
  
  //   xhr.open('POST', url, true);
  //   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  //   xhr.onreadystatechange = function () {
  //     if (xhr.readyState === 4 && xhr.status === 200) {
  //       // Handle the response from the server
  //       const response = JSON.parse(xhr.responseText);
  //       if (response.success) {
  //         alert(response.message);
  //       } else {
  //         alert('Data could not be received from PHP!');
  //       }
  //     }
  //   };
  
  //   const params = 'selectedOptions=' + JSON.stringify(options);
  //   xhr.send(params);
  // }
  


  // function sendSelectedOptions(options) {
  //   const xhr = new XMLHttpRequest();
  //   const url = 'coordinator-PEO-PLO-Managment.php';
  //   xhr.open('POST', url, true);
  //   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  //   xhr.onreadystatechange = function () {
  //     if (xhr.readyState === 4 && xhr.status === 200) {
  //       // Handle the response from the server
  //       const response = xhr.responseText;
  //       console.log(response);
  //       alert(response)
  //     }
  //   };
  
  //   const params = 'selectedOptions=' + JSON.stringify(options);
  //   xhr.send(params);
  // }


  // function sendSelectedOptions(options) {
  //   const xhr = new XMLHttpRequest();
  //   const url = 'coordinator-PEO-PLO-Managment.php';
  
  //   xhr.open('POST', url, true);
  //   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  //   xhr.onreadystatechange = function () {
  //     if (xhr.readyState === 4 && xhr.status === 200) {
  //       // Handle the response from the server if needed
  //     }
  //   };
  
  //   const params = 'selectedOptions=' + JSON.stringify(options);
  //   xhr.send(params);
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
