document.addEventListener('DOMContentLoaded', () => {
  // ===================================================Elements Same for All
  const addQAMFMaptoCLOModalLabel = document.getElementById(
    'add-QAMF-Mapto-CLO-ModalLabel'
  );
  const QAMFMaptoCLOModalAddUpdateButton = document.getElementById(
    'QAMF-Mapto-CLO-Modal-AddUpdate-Btn'
  );

  let deleteRowData;
  $('#confirmDeleteQAMF-mapToCLOEntry-Btn').on('click', () => {
    console.log('Deletion confirmed............');
    console.log(deleteRowData);

    //deletion logic for deleteRowData

    // Reset the deleteRowData variable
    deleteRowData = null;
  });

  // Cancel button event handler
  $('#delete-QAMF-Entry-ConfirmationModal').on('hidden.bs.modal', function () {
    // Reset the deleteRowData, when the modal is closed/cancelled
    deleteRowData = null;
  });

  // Get the select element and label element
  var selectElement = document.getElementById('activityNo-Questions');
  var labelElement = document.querySelector(
    'label[for="activityNo-Questions"]'
  );
  // create option for select dropDown
  var option = document.createElement('option');

  // Function to remove all options from the select element
  function removeAllOptions() {
    for (var i = selectElement.options.length - 1; i > 0; i--) {
      selectElement.remove(i);
    }
  }

  // ================================================Quiz List Table Managment
  const mapQuiztoCLOsBtn = document.getElementById('mapQuiztoCLOsBtn');

  mapQuiztoCLOsBtn.addEventListener('click', () => {
    addQAMFMaptoCLOModalLabel.innerHTML = 'New Quiz Mapping with CLO';
    QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Add';

    // remove all previous options intially
    removeAllOptions();

    // Change the select label
    labelElement.innerHTML = 'Quiz No';

    // add new options
    for (let i = 0; i < 3; i++) {
      // create option for select dropDown
      var option = document.createElement('option');

      option.value = `Quiz-${i + 1}`;
      option.text = `Quiz-${i + 1}`;

      selectElement.appendChild(option);
    }
  });

  const tableQuizList = $('#QuizList-dataTable').DataTable({
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
  $('#QuizList-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tableQuizList.row($(this).closest('tr')).data();
    console.log('Quiz List-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addQAMFMaptoCLOModalLabel.innerHTML =
      'Update Existing Quiz Mapping with CLO';
    QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Update';

    $('#addUpdate-QAMF-Mapto-CLO-Modal').modal('show');

    // Use the rowData to populate the fields in the modal
    // $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
    // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
    // Repeat for other fields
  });

  $('#QuizList-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteRowData = tableQuizList.row($(this).closest('tr')).data();
      console.log('Quiz List-Table : ');
      console.log(deleteRowData);

      // Open deleteFinalMarksConfirmationModal
      $('#delete-QAMF-Entry-ConfirmationModal').modal('show');
    }
  );

  const QuizesMaptoCLOData = [
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

  QuizesMaptoCLOData.forEach((object) => {
    tableQuizList.row.add([
      object.id,
      object.code,
      object.name,
      object.code,
      '',
    ]);
  });

  tableQuizList.draw();

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // Assinment List Table Managment
  const mapAssingmenttoCLOsBtn = document.getElementById(
    'mapAssingmenttoCLOsBtn'
  );

  mapAssingmenttoCLOsBtn.addEventListener('click', () => {
    addQAMFMaptoCLOModalLabel.innerHTML = 'New Assignment Mapping with CLO';
    QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Add';

    // remove all previous options intially
    removeAllOptions();

    // Change the select label
    labelElement.innerHTML = 'Assingment No';

    // add new options
    for (let i = 0; i < 3; i++) {
      // create option for select dropDown
      var option = document.createElement('option');

      option.value = `Assingment-${i + 1}`;
      option.text = `Assingment-${i + 1}`;

      selectElement.appendChild(option);
    }
  });

  const tableAssingmentList = $('#AssingmentList-dataTable').DataTable({
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
  $('#AssingmentList-dataTable tbody').on(
    'click',
    'button.edit-button',
    function () {
      let rowData = tableAssingmentList.row($(this).closest('tr')).data();
      console.log('Assingment List-Table : ');
      console.log(rowData);

      // updating inner HTML content of modal title and action button.
      addQAMFMaptoCLOModalLabel.innerHTML =
        'Update Existing Assignment Mapping with CLO';
      QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Update';

      $('#addUpdate-QAMF-Mapto-CLO-Modal').modal('show');

      // Use the rowData to populate the fields in the modal
      // $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
      // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
      // Repeat for other fields
    }
  );

  $('#AssingmentList-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteRowData = tableAssingmentList.row($(this).closest('tr')).data();
      console.log('Assingment List-Table : ');
      console.log(deleteRowData);

      // Open deleteFinalMarksConfirmationModal
      $('#delete-QAMF-Entry-ConfirmationModal').modal('show');
    }
  );

  const AssingmentsMaptoCLOData = [
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

  AssingmentsMaptoCLOData.forEach((object) => {
    tableAssingmentList.row.add([
      object.id,
      object.code,
      object.name,
      object.code,
      '',
    ]);
  });

  tableAssingmentList.draw();

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // ===============================================MidQuestion List Table Managment
  const mapMidQuestiontoCLOsBtn = document.getElementById(
    'mapMidQuestiontoCLOsBtn'
  );

  mapMidQuestiontoCLOsBtn.addEventListener('click', () => {
    addQAMFMaptoCLOModalLabel.innerHTML = 'New Mid Question Mapping with CLO';
    QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Add';

    // remove all previous options intially
    removeAllOptions();

    // Change the select label
    labelElement.innerHTML = 'Qestion No';

    // add new options
    for (let i = 0; i < 3; i++) {
      // create option for select dropDown
      var option = document.createElement('option');

      option.value = `Q${i + 1}`;
      option.text = `Qestion-${i + 1}`;

      selectElement.appendChild(option);
    }
  });

  const tableMidQuestionList = $('#MidQuestionList-dataTable').DataTable({
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
  $('#MidQuestionList-dataTable tbody').on(
    'click',
    'button.edit-button',
    function () {
      let rowData = tableMidQuestionList.row($(this).closest('tr')).data();
      console.log('MidQuestion List-Table : ');
      console.log(rowData);

      // updating inner HTML content of modal title and action button.
      addQAMFMaptoCLOModalLabel.innerHTML =
        'Update Existing Mid Qestion Mapping with CLO';
      QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Update';

      $('#addUpdate-QAMF-Mapto-CLO-Modal').modal('show');

      // Use the rowData to populate the fields in the modal
      // $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
      // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
      // Repeat for other fields
    }
  );

  $('#MidQuestionList-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteRowData = tableMidQuestionList.row($(this).closest('tr')).data();
      console.log('MidQuestion List-Table : ');
      console.log(deleteRowData);

      // Open deleteFinalMarksConfirmationModal
      $('#delete-QAMF-Entry-ConfirmationModal').modal('show');
    }
  );

  const MidQuestionMaptoCLOData = [
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

  MidQuestionMaptoCLOData.forEach((object) => {
    tableMidQuestionList.row.add([
      object.id,
      object.code,
      object.name,
      object.code,
      '',
    ]);
  });

  tableMidQuestionList.draw();

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  // ==============================================FinalQuestion List Table Managment
  const mapFinalQuestiontoCLOsBtn = document.getElementById(
    'mapFinalQuestiontoCLOsBtn'
  );

  mapFinalQuestiontoCLOsBtn.addEventListener('click', () => {
    addQAMFMaptoCLOModalLabel.innerHTML = 'New Final Qestion Mapping with CLO';
    QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Add';

    // remove all previous options intially
    removeAllOptions();

    // Change the select label
    labelElement.innerHTML = 'Qestion No';

    // add new options
    for (let i = 0; i < 5; i++) {
      // create option for select dropDown
      var option = document.createElement('option');

      option.value = `Q${i + 1}`;
      option.text = `Question-${i + 1}`;

      selectElement.appendChild(option);
    }
  });

  const tableFinalQuestionList = $('#FinalQuestionList-dataTable').DataTable({
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
  $('#FinalQuestionList-dataTable tbody').on(
    'click',
    'button.edit-button',
    function () {
      let rowData = tableFinalQuestionList.row($(this).closest('tr')).data();
      console.log('FinalQuestion List-Table : ');
      console.log(rowData);

      // updating inner HTML content of modal title and action button.
      addQAMFMaptoCLOModalLabel.innerHTML =
        'Update Existing Final Qestion Mapping with CLO';
      QAMFMaptoCLOModalAddUpdateButton.innerHTML = 'Update';

      $('#addUpdate-QAMF-Mapto-CLO-Modal').modal('show');

      // Use the rowData to populate the fields in the modal
      // $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
      // $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
      // Repeat for other fields
    }
  );

  $('#FinalQuestionList-dataTable tbody').on(
    'click',
    'button.delete-button',
    function () {
      deleteRowData = tableFinalQuestionList.row($(this).closest('tr')).data();
      console.log('FinalQuestion List-Table : ');
      console.log(deleteRowData);

      // Open deleteFinalMarksConfirmationModal
      $('#delete-QAMF-Entry-ConfirmationModal').modal('show');
    }
  );

  const FinalQuestionMaptoCLOData = [
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

  FinalQuestionMaptoCLOData.forEach((object) => {
    tableFinalQuestionList.row.add([
      object.id,
      object.code,
      object.name,
      object.code,
      '',
    ]);
  });

  tableFinalQuestionList.draw();

  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
});
