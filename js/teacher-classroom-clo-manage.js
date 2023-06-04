document.addEventListener('DOMContentLoaded', () => {
    const addCLObutton = document.getElementById('addCLOBtn');
    const addCLOModalTitle = document.getElementById('addCLOModalLabel');
    const CLOmodalAddUpdateBtn = document.getElementById('CLO-modalAddUpdateBtn');
  
    addCLObutton.addEventListener('click', () => {
      addCLOModalTitle.innerHTML = 'Add CLO';
      CLOmodalAddUpdateBtn.innerHTML = 'Add';
    });
  
    const tableCLO = $('#CLO-dataTable').DataTable({
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
              '<div class="d-flex justify-content-between"><button class="icon-button edit-button" data-id="' +
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
  
    // Add event listener for edit button in CLO DataTable
    $('#CLO-dataTable tbody').on('click', 'button.edit-button', function () {
      let rowData = tableCLO.row($(this).closest('tr')).data();
      console.log('CLO-Table : ');
      console.log(rowData);
  
      // updating inner HTML content of modal title and action button.
      addCLOModalTitle.innerHTML = 'Update CLO';
      CLOmodalAddUpdateBtn.innerHTML = 'Update';
  
      // Open addCLOModal
      $('#addCLOModal').modal('show');
  
      // Use the rowData to populate the fields in the modal
      $('#addCLOModal input[name="CLO-code"]').val(rowData.Code);
      $('#addCLOModal input[name="CLO-name"]').val(rowData.Name);
      // Repeat for other fields
    });

const CLOdata = [
  {
    id: 1,
    code: "ABC123",
    name: "Example Course 1",
    description: "This is a description for Example Course 1.",
    kPI: 4.5,
    mappingPLOs: "PLO-1 PLO-3",
    type: "Science",
    isOBEenabled: true
  },
  {
    id: 2,
    code: "DEF456",
    name: "Example Course 2",
    description: "This is a description for Example Course 2.",
    kPI: 3.8,
    mappingPLOs: "PLO-2 PLO-4",
    type: "Arts",
    isOBEenabled: false
  },
  {
    id: 3,
    code: "GHI789",
    name: "Example Course 3",
    description: "This is a description for Example Course 3.",
    kPI: 4.2,
    mappingPLOs: "PLO-1 PLO-4",
    type: "Commerce",
    isOBEenabled: true
  },
  {
    id: 4,
    code: "JKL012",
    name: "Example Course 4",
    description: "This is a description for Example Course 4.",
    kPI: 3.9,
    mappingPLOs: "PLO-2 PLO-3",
    type: "Engineering",
    isOBEenabled: false
  },
  {
    id: 5,
    code: "MNO345",
    name: "Example Course 5",
    description: "This is a description for Example Course 5.",
    kPI: 4.1,
    mappingPLOs: "PLO-3 PLO-4",
    type: "Business",
    isOBEenabled: true
  },
  {
    id: 6,
    code: "PQR678",
    name: "Example Course 6",
    description: "This is a description for Example Course 6.",
    kPI: 4.0,
    mappingPLOs: "PLO-1 PLO-2",
    type: "Computer Science",
    isOBEenabled: false
  },
  {
    id: 7,
    code: "STU901",
    name: "Example Course 7",
    description: "This is a description for Example Course 7.",
    kPI: 3.7,
    mappingPLOs: "PLO-2 PLO-4",
    type: "Social Sciences",
    isOBEenabled: true
  },
  {
    id: 8,
    code: "VWX234",
    name: "Example Course 8",
    description: "This is a description for Example Course 8.",
    kPI: 4.3,
    mappingPLOs: "PLO-1 PLO-3",
    type: "Health Sciences",
    isOBEenabled: false
  }
];
    
        // Create a Cell for checkbox
        
        CLOdata.forEach((object) => {

                const checkboxContainer = document.createElement('div');
                checkboxContainer.classList.add('col-lg-2','d-flex','w-100','justify-content-center','align-items-center');
                
                const formCheckDiv = document.createElement('div');
                formCheckDiv.classList.add('form-check');
                
                const isCheckedInput = document.createElement('input');
                isCheckedInput.classList.add('form-check-input');
                isCheckedInput.setAttribute('type', 'checkbox');
                isCheckedInput.setAttribute('id', 'isOBEenabled');
                
                const isCheckedLabel = document.createElement('label');
                isCheckedLabel.classList.add('form-check-label');
                isCheckedLabel.setAttribute('for', 'isOBEenabled');
                
                checkboxContainer.appendChild(formCheckDiv);
                formCheckDiv.appendChild(isCheckedInput);
                formCheckDiv.appendChild(isCheckedLabel);

               
      tableCLO.row.add([
        object.id,
        object.code,
        object.name,
        object.description,
        object.kPI,
        object.mappingPLOs,
        object.type,
        checkboxContainer.outerHTML,
        "",
      ]);
    });
  
    tableCLO.draw();
  
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  
    //logic for selecting multiple options from Mapping CLO DropDown in add/update PLO modal.
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
    }
  
    function enableOption(optionValue) {
      for (let i = 0; i < dropdown.options.length; i++) {
        if (dropdown.options[i].value === optionValue) {
          dropdown.options[i].disabled = false;
          break;
        }
      }
    }
  
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
  