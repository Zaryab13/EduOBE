document.addEventListener('DOMContentLoaded', () => {
  const addPEObutton = document.getElementById('addPEOBtn');
  const addPLObutton = document.getElementById('addPLOBtn');
  const addPEOModalTitle = document.getElementById('addPEOModalLabel');
  const addPLOModalTitle = document.getElementById('addPLOModalLabel');
  const PEOmodalAddUpdateBtn = document.getElementById('PEO-modalAddUpdateBtn');
  const PLOmodalAddUpdateBtn = document.getElementById('PLO-modalAddUpdateBtn');

  addPEObutton.addEventListener('click', () => {
    addPEOModalTitle.innerHTML = 'Add PEO';
    PEOmodalAddUpdateBtn.innerHTML = 'Add';
  });

  addPLObutton.addEventListener('click', () => {
    addPLOModalTitle.innerHTML = 'ADD PLO';
    PLOmodalAddUpdateBtn.innerHTML = 'Add';
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
            '<button class="icon-button edit-button" data-id="' +
            row.id +
            '"><img src="../icons/edit.svg" alt="Edit"></button>' +
            '<button class="icon-button delete-button" data-id="' +
            row.id +
            '"><img src="../icons/trash.svg" alt="Delete"></button>'
          );
        },
      },
    ],
  });

  // Add event listener for edit button in PEO DataTable
  $('#PEO-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tablePEO.row($(this).closest('tr')).data();
    console.log('PEO-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addPEOModalTitle.innerHTML = 'Update PEO';
    PEOmodalAddUpdateBtn.innerHTML = 'Update';

    // Open addPEOModal
    $('#addPEOModal').modal('show');

    // Use the rowData to populate the fields in the modal
    $('#addPEOModal input[name="PEO-code"]').val(rowData.Code);
    $('#addPEOModal input[name="PEO-name"]').val(rowData.Name);
    // Repeat for other fields
  });

  const PEOdata = [
    {
      id: '1',
      Code: 'PEO-1',
      Name: '',
      Program: 'BS-SE',
      Description:
        'Be able to address real life problems by translating learned engineering knowledge for designing and implementing computing systems.',
    },
    {
      id: '2',
      Code: 'PEO-2',
      Name: '',
      Program: 'BS-SE',
      Description:
        'Be able to apply in-depth computer systems engineering knowledge to identify and solve technical challenges fulfilling the needs of the society with consideration of the environmental impact and ethical values.',
    },
    {
      id: '3',
      Code: 'PEO-3',
      Name: '',
      Program: 'BS-SE',
      Description:
        'Be able to lead as an individual or contribute as a team member and continually adapt with the upcoming trends of technology by continuous professional development for meeting individual and societal goals.',
    },
    {
      id: '4',
      Code: 'PEO-4',
      Name: '',
      Program: 'BS-SE',
      Description:
        'akistan Engineering Council (PEC) has provided guidelines and twelve graduate attributes. Department of Computer Systems Engineering have adopted those attributes as Program learning outcomes (PLOs).',
    },
  ];

  PEOdata.forEach((object) => {
    tablePEO.row.add([
      object.id,
      object.Code,
      object.Name,
      object.Description,
      object.Program,
    ]);
  });

  tablePEO.draw();

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
            '<button class="icon-button edit-button" data-id="' +
            row.id +
            '"><img src="../icons/edit.svg" alt="Edit"></button>' +
            '<button class="icon-button delete-button" data-id="' +
            row.id +
            '"><img src="../icons/trash.svg" alt="Delete"></button>'
          );
        },
      },
    ],
  });

  // Add event listener for edit button in PLO DataTable
  $('#PLO-dataTable tbody').on('click', 'button.edit-button', function () {
    let rowData = tablePLO.row($(this).closest('tr')).data();
    console.log('PLO-Table : ');
    console.log(rowData);

    // updating inner HTML content of modal title and action button.
    addPLOModalTitle.innerHTML = 'Update PLO';
    PLOmodalAddUpdateBtn.innerHTML = 'Update';

    // Open addPLOModal
    $('#addPLOModal').modal('show');

    // Use the rowData to populate the fields in the modal
    $('#addPLOModal input[name="name"]').val(rowData.name);
    $('#addPLOModal input[name="age"]').val(rowData.age);
    // Repeat for other fields
  });

  const PLOdata = [
    {
      id: '1',
      Code: 'PLO-1',
      Name: 'Engineering Knowledge',
      Description:
        'An ability to apply knowledge of mathematics, science, engineering fundamentals and an engineering specialization to the solution of complex engineering problems.',
      KPI: '40',
      PEOsID: 'PEO-1 PEO-3',
    },
    {
      id: '2',
      Code: 'PLO-2',
      Name: 'Problem Analysis',
      Description:
        'An ability to identify, formulate, research literature, and analyze complex engineering problems reaching substantiated conclusions using first principles of mathematics, natural sciences and engineering sciences',
      KPI: '40',
      PEOsID: 'PEO-1 PEO-2',
    },
    {
      id: '3',
      Code: 'PLO-3',
      Name: 'Design/Development of Solutions',
      Description:
        'An ability to design solutions for complex engineering problems and design systems, components or processes that meet specified needs with appropriate consideration for public health and safety, cultural, societal, and environmental considerations',
      KPI: '40',
      PEOsID: 'PEO-2 PEO-3',
    },
    {
      id: '4',
      Code: 'PLO-4',
      Name: 'Investigation',
      Description:
        'An ability to investigate complex engineering problems in a methodical way including literature survey, design and conduct of experiments, analysis and interpretation of experimental data, and synthesis of information to derive valid conclusions',
      KPI: '40',
      PEOsID: 'PEO-3 PEO-4',
    },
    {
      id: '5',
      Code: 'PLO-5',
      Name: 'Modern Tool Usage',
      Description:
        'An ability to create, select and apply appropriate techniques, resources, and modern engineering and IT tools, including prediction and modelling, to complex engineering activities, with an understanding of the limitations',
      KPI: '40',
      PEOsID: 'PEO-1 PEO-2',
    },
    {
      id: '6',
      Code: 'PLO-6',
      Name: 'The Engineer and Society',
      Description:
        'An ability to apply reasoning informed by contextual knowledge to assess societal, health, safety, legal and cultural issues and the consequent responsibilities relevant to professional engineering practice and solution to complex engineering problems',
      KPI: '40',
      PEOsID: 'PEO-2 PEO-3',
    },
    {
      id: '7',
      Code: 'PLO-7',
      Name: 'Environment and Sustainability',
      Description:
        'An ability to understand the impact of professional engineering solutions in societal and environmental contexts and demonstrate knowledge of and need for sustainable development',
      KPI: '40',
      PEOsID: 'PEO-1 PEO-4',
    },
    {
      id: '8',
      Code: 'PLO-8',
      Name: 'Ethics',
      Description:
        'Apply ethical principles and commit to professional ethics and responsibilities and norms of engineering practice',
      KPI: '40',
      PEOsID: 'PEO-3 PEO-4',
    },
    {
      id: '9',
      Code: 'PLO-9',
      Name: 'Individual and Team Work',
      Description:
        ' An ability to work effectively, as an individual or in a team, on multifaceted and /or multidisciplinary settings',
      KPI: '40',
      PEOsID: 'PEO-2 PEO-3',
    },
    {
      id: '10',
      Code: 'PLO-10',
      Name: 'Communication',
      Description:
        'An ability to communicate effectively, orally as well as in writing, on complex engineering activities with the engineering community and with society at large, such as being able to comprehend and write effective reports and design documentation, make effective presentations, and give and receive clear instructions',
      KPI: '40',
      PEOsID: 'PEO-1 PEO-2',
    },
    {
      id: '11',
      Code: 'PLO-11',
      Name: 'Project Management',
      Description:
        'An ability to demonstrate management skills and apply engineering principles to one’s own work, as a member and/or leader in a team, to manage projects in a multidisciplinary environment',
      KPI: '40',
      PEOsID: 'PEO-2 PEO-3',
    },
    {
      id: '12',
      Code: 'PLO-12',
      Name: 'Lifelong Learning',
      Description:
        'An ability to recognize the importance of and pursue lifelong learning in the broader context of innovation and technological developments',
      KPI: '40',
      PEOsID: 'PEO-2 PEO-4',
    },
  ];

  PLOdata.forEach((object) => {
    tablePLO.row.add([
      object.id,
      object.Code,
      object.Name,
      object.Description,
      object.KPI,
      object.PEOsID,
    ]);
  });

  tablePLO.draw();

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
