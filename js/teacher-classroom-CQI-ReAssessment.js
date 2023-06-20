document.addEventListener('DOMContentLoaded', () => {
    // const addCQIbutton = document.getElementById('addCQIBtn');
    // const addCQIModalTitle = document.getElementById('addCQIModalLabel');
    // const CQImodalAddUpdateBtn = document.getElementById('CQI-modalAddUpdateBtn');
  
    // addCQIbutton.addEventListener('click', () => {
    //   addCQIModalTitle.innerHTML = 'Add CQI';
    //   CQImodalAddUpdateBtn.innerHTML = 'Add';
    // });
  
    const tableReAssess = $('#ReAssess-dataTable').DataTable({
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
              '<div class="d-flex justify-content-center"><button class="icon-button ReAssess-button" data-id="' +
              row.id +
              '"><img src="../icons/Redo.png" alt="Edit"></button>'
            );
          },
        },
      ],
    });
  
    // Add event listener for edit button in ReAssess DataTable
    $('#ReAssess-dataTable tbody').on('click', 'button.ReAssess-button', function () {
      let rowData = tableReAssess.row($(this).closest('tr')).data();
      console.log('ReAssess-Table : ');
      console.log(rowData);
  
      // updating inner HTML content of modal title and action button.
    //   addReAssessModalTitle.innerHTML = 'Update ReAssess';
    //   ReAssessmodalAddUpdateBtn.innerHTML = 'Update';
  
      // Open addCQIModal
      $('#ReAssessModal').modal('show');
  
      // Use the rowData to populate the fields in the modal
      $('#ReAssessModal input[name="ReAssess-code"]').val(rowData.Code);
      $('#ReAssessModal input[name="ReAssess-name"]').val(rowData.Name);
      // Repeat for other fields
    });

const ReAssessdata = [
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
        
        ReAssessdata.forEach((object) => {

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

               
      tableReAssess.row.add([
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
  
    tableReAssess.draw();
  
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  });
  