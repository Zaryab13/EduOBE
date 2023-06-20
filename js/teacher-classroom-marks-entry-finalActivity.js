document.addEventListener('DOMContentLoaded', () => {
    const addMarksEntryFinalbutton = document.getElementById('addMarksEntryFinalBtn');
    const addMarksEntryFinalModalTitle = document.getElementById('addMarksEntryFinalModalLabel');
    const MarksEntrymodalAddUpdateBtn = document.getElementById('MarksEntry-modalAddUpdateBtn');
  
    addMarksEntryFinalbutton.addEventListener('click', () => {
      addMarksEntryFinalModalTitle.innerHTML = 'Add Marks';
      MarksEntrymodalAddUpdateBtn.innerHTML = 'Add';
    });
  
    const tableMarksEntry = $('#MarksEntryFinal-dataTable').DataTable({
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
              '"><img src="../icons/trash.svg" alt="Delete"></button> </div>'
            );
          },
        },
      ],
    });
  
    // Add event listener for edit button in MarksEntry DataTable
    $('#MarksEntry-dataTable tbody').on('click', 'button.edit-button', function () {
      let rowData = tableMarksEntry.row($(this).closest('tr')).data();
      console.log('MarksEntry-Table : ');
      console.log(rowData);
  
      // updating inner HTML content of modal title and action button.
      addMarksEntryFinalModalTitle.innerHTML = 'Update Marks';
      MarksEntrymodalAddUpdateBtn.innerHTML = 'Update';
  
      // Open addMarksEntryFinalModal
      $('#addMarksEntryFinalModal').modal('show');
  
      // Use the rowData to populate the fields in the modal
      $('#addMarksEntryFinalModal input[name="MarksEntry-code"]').val(rowData.Code);
      $('#addMarksEntryFinalModal input[name="MarksEntry-name"]').val(rowData.Name);
      // Repeat for other fields
    });
  
    const MarksEntrydata = [
      {
        id: '1',
        Code: 'MarksEntry-1',
        Name: '',
        Program: 'BS-SE',
        Description:
          'Be able to address real life problems by translating learned engineering knowledge for designing and implementing computing systems.',
      },
      {
        id: '2',
        Code: 'MarksEntry-2',
        Name: '',
        Program: 'BS-SE',
        Description:
          'Be able to apply in-depth computer systems engineering knowledge to identify and solve technical challenges fulfilling the needs of the society with consideration of the environmental impact and ethical values.',
      },
      {
        id: '3',
        Code: 'MarksEntry-3',
        Name: '',
        Program: 'BS-SE',
        Description:
          'Be able to lead as an individual or contribute as a team member and continually adapt with the upcoming trends of technology by continuous professional development for meeting individual and societal goals.',
      },
      {
        id: '4',
        Code: 'MarksEntry-4',
        Name: '',
        Program: 'BS-SE',
        Description:
          'akistan Engineering Council (PEC) has provided guidelines and twelve graduate attributes. Department of Computer Systems Engineering have adopted those attributes as Program learning outcomes (PLOs).',
      },
    ];
  
    MarksEntrydata.forEach((object) => {
      tableMarksEntry.row.add([
        object.id,
        object.Code,
        object.Description,
        ""
      ]);
    });
  
    tableMarksEntry.draw();
  
  });
  