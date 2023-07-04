document.addEventListener('DOMContentLoaded', () => {
  const addFinalMarksButton = document.getElementById('addFinalMarksBtn');
  const addFinalMarksModalTitle = document.getElementById(
    'addFinalMarksModalLabel'
  );
  const FinalMarksModalAddUpdateBtn = document.getElementById(
    'FinalMarksModalAddUpdateBtn'
  );

  addFinalMarksButton.addEventListener('click', () => {
    addFinalMarksModalTitle.innerHTML = 'Add Marks';
    FinalMarksModalAddUpdateBtn.innerHTML = 'Add';
  });

  const tableFinalMarks = $('#FinalMarks-dataTable').DataTable({
    paging: true,
    lengthMenu: [5, 10, 25, 50],
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

  // Add event listener for edit button in FinalMarks DataTable
  $('#FinalMarks-dataTable tbody').on(
    'click',
    'button.edit-button',
    function () {
      let rowData = tableFinalMarks.row($(this).closest('tr')).data();
      console.log('FinalMarks-Table : ');
      console.log(rowData);

      // updating inner HTML content of modal title and action button.
      addFinalMarksModalTitle.innerHTML = 'Update Marks';
      FinalMarksModalAddUpdateBtn.innerHTML = 'Update';

      $('#addUpdateFinalMarksModal').modal('show');

      // Use the rowData to populate the fields in the modal
      // $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
      // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
      // Repeat for other fields
    }
  );

  let deleteRowData;
  $('#FinalMarks-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteRowData = tableFinalMarks.row($(this).closest('tr')).data();
      console.log('FinalMarks-Table : ');
      console.log(deleteRowData);

      // Open deleteFinalMarksConfirmationModal
      $('#deleteFinalMarksConfirmationModal').modal('show');
    }
  );

  $('#confirmDeleteFinalMarksBtn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deleteRowData);

    //deletion logic for deleteRowData

    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#deleteFinalMarksConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });

  const FinalMarksData = [
    {
      id: '1',
      code: 'CSE101',
      name: 'Bachelor of Computer Science',
      type: 'Degree',
      noOfSemesters: 8,
      ProgramHead: 'Dr. Jane Johnson',
      assessmentMethod: 'Continuous Assessment',
      passingMarks: 60,
    },
    {
      id: '2',
      code: 'ENG202',
      name: 'Master of English Literature',
      type: 'Postgraduate Degree',
      noOfSemesters: 4,
      ProgramHead: 'Prof. Michael Smith',
      assessmentMethod: 'Exams and Assignments',
      passingMarks: 70,
    },
    {
      id: '3',
      code: 'MED301',
      name: 'Doctor of Medicine',
      type: 'Professional Degree',
      noOfSemesters: 12,
      ProgramHead: 'Dr. Emily Davis',
      assessmentMethod: 'Clinical Rotations and Exams',
      passingMarks: 65,
    },
    {
      id: '4',
      code: 'BUS401',
      name: 'Executive Master of Business Administration',
      type: 'Postgraduate Degree',
      noOfSemesters: 6,
      ProgramHead: 'Dr. William Anderson',
      assessmentMethod: 'Group Projects and Presentations',
      passingMarks: 75,
    },
    {
      id: '5',
      code: 'ART201',
      name: 'Diploma in Fine Arts',
      type: 'Diploma',
      noOfSemesters: 3,
      ProgramHead: 'Prof. Samantha Brown',
      assessmentMethod: 'Portfolio Assessment',
      passingMarks: 50,
    },
    {
      id: '6',
      code: 'SCI501',
      name: 'Ph.D. in Biological Sciences',
      type: 'Doctorate Degree',
      noOfSemesters: 10,
      ProgramHead: 'Dr. Robert Wilson',
      assessmentMethod: 'Research Publications and Dissertation',
      passingMarks: 80,
    },
    {
      id: '7',
      code: 'MKT301',
      name: 'Bachelor of Marketing',
      type: 'Degree',
      noOfSemesters: 8,
      ProgramHead: 'Prof. Elizabeth Thompson',
      assessmentMethod: 'Exams and Case Studies',
      passingMarks: 65,
    },
    {
      id: '8',
      code: 'PSY401',
      name: 'Master of Psychology',
      type: 'Postgraduate Degree',
      noOfSemesters: 4,
      ProgramHead: 'Dr. Benjamin Davis',
      assessmentMethod: 'Research Projects and Presentations',
      passingMarks: 70,
    },
  ];

  FinalMarksData.forEach((object) => {
    tableFinalMarks.row.add([
      object.id,
      object.code,
      object.name,
      object.code,
      object.code,
      object.code,
      object.code,
      object.code,
      '',
    ]);
  });

  tableFinalMarks.draw();

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
});
