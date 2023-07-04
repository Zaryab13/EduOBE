document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  const addBatchbutton = document.getElementById('addBatchBtn');
  const addBatchModalTitle = document.getElementById('addBatchModalLabel');
  const BatchmodalAddUpdateBtn = document.getElementById('Batch-modalAddUpdateBtn');
  const addUpdateBatchForm = document.getElementById('addUpdateBatchForm');

  addBatchbutton.addEventListener('click', () => {
    addBatchModalTitle.innerHTML = 'ADD Batch';
    BatchmodalAddUpdateBtn.innerHTML = 'Add';
    addUpdateBatchForm.action = `addBatchQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
  });

  const tableBatch = $('#Batch-dataTable').DataTable({
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
  
  var keys = [
    '',
    'batch_id',
    'name',
    'num_of_std', 
    'starting_date',
    'ending_date', 
    'program',
    'bos',
    'semester',
  ];

  // Add event listener for edit button in Batch DataTable
  $('#Batch-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tableBatch.row($(this).closest('tr')).data();
    console.log('Batch-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addBatchModalTitle.innerHTML = 'Update Batch';
    BatchmodalAddUpdateBtn.innerHTML = 'Update';

    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }

    // Open addBatchModal
    $('#addBatchModal').modal('show');
    addUpdateBatchForm.action = `updateBatchQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`

    // Use the rowData to populate the fields in the modal
    $('#addBatchModal input[name="batchId"]').val(convertedObject.batch_id);
    $('#addBatchModal input[name="name"]').val(convertedObject.name);
    $('#addBatchModal input[name="numOfStudent"]').val(convertedObject.num_of_std);
    $('#addBatchModal input[name="startingDate"]').val(convertedObject.starting_date);
    $('#addBatchModal input[name="endingDate"]').val(convertedObject.ending_date);
    $('#addBatchModal select[name="program"]').val(convertedObject.program);
    $('#addBatchModal select[name="BOS"]').val(convertedObject.bos);
    $('#addBatchModal select[name="semester"]').val(convertedObject.semester);
    // Repeat for other fields
  });

  let deleteRowData; // Variable to store the rowData for delete event.
  // Add event listener for delete button button in Batch DataTable
  $('#Batch-dataTable tbody').on('click', 'button.delete-button', function () {
    // let rowData = tableBatch.row($(this).closest('tr')).data();
    deleteRowData = tableBatch.row($(this).closest('tr')).data();
    console.log('Batch-Table : ');
    console.log(deleteRowData);

    // Open deleteBatchConfirmationModal
    $('#deleteBatchConfirmationModal').modal('show');
  });

  $('#confirmDeleteBatchBtn').on('click', () => {
    // console.log('Deletion confirmed............');
    // console.log(deleteRowData);

    //deletion logic for deleteRowData
    var delete_selectedProgram = deleteRowData[1];
    // console.log(delete_selectedProgramCode)

    // const url = `deleteBOSDetailQuery.php?code=${delete_selectedProgramCode}`;
    const url = `deleteBatchQuery.php?batchId=${delete_selectedProgram}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#deleteBatchConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });

  // ===========================================================  draw table
  var data = jsonData;

  const Batchdata = [];

  data.forEach((object) => {
    Batchdata.push(object);
    // console.log(object);      
  });
  
  var counter=0;
  Batchdata.forEach((object) => {
    counter++
    tableBatch.row.add([
      counter,
      object.batch_id,
      object.name,
      object.num_of_std,
      object.starting_date,
      object.ending_date,
      object.program,
      object.bos,
      object.semester,
      '',
    ]);
  });

  tableBatch.draw();
  counter = 0;

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
