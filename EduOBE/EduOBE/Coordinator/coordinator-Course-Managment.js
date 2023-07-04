document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  const addCoursebutton = document.getElementById('addCourseBtn');
  const addCourseModalTitle = document.getElementById('addCourseModalLabel');
  const CoursemodalAddUpdateBtn = document.getElementById('Course-modalAddUpdateBtn');
  const addUpdateCourseForm = document.getElementById('addUpdateCourseForm');

  addCoursebutton.addEventListener('click', () => {
    addCourseModalTitle.innerHTML = 'ADD Course';
    CoursemodalAddUpdateBtn.innerHTML = 'Add';
    addUpdateCourseForm.action = `addCourseQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
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

  var keys = [
    '',
    'code', 
    'name', 
    'delivery_formate', 
    'course_level',
  ];
  // Add event listener for edit button in Course DataTable
  $('#Course-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tableCourse.row($(this).closest('tr')).data();
    console.log('Course-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addCourseModalTitle.innerHTML = 'Update Course';
    CoursemodalAddUpdateBtn.innerHTML = 'Update';

    let convertedObject = {};
    for (let i = 0; i < keys.length; i++) {
      convertedObject[keys[i]] = rowData[i];
    }

    // Open addCourseModal
    $('#addCourseModal').modal('show');
    addUpdateCourseForm.action = `updateCourseQuery.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // Use the rowData to populate the fields in the modal
    $('#addCourseModal input[name="code"]').val(convertedObject.code);
    $('#addCourseModal input[name="name"]').val(convertedObject.name);
    $('#addCourseModal select[name="deliveryFormate"]').val(convertedObject.delivery_formate);
    $('#addCourseModal select[name="courseLevel"]').val(convertedObject.course_level);
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
    var delete_selectedProgramCode = deleteRowData[1];
    console.log(delete_selectedProgramCode)
    const url = `deleteCourseQuery.php?code=${delete_selectedProgramCode}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
    window.location.href = url;
    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#deleteCourseConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });
  // ==================================================  draw table
  var data = jsonCourseData;
  const Coursedata = [];

  data.forEach((object) => {
    Coursedata.push(object);
    console.log(object);      
  });
  
  var counter = 0;
  Coursedata.forEach((object) => {
    counter++;
    tableCourse.row.add([
      counter,
      object.code,
      object.name,
      object.delivery_formate,
      object.course_level,
      '',
    ]);
  });

  tableCourse.draw();
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
