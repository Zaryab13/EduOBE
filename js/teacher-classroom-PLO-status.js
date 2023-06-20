document.addEventListener('DOMContentLoaded', () => {
    
    const tableploStatus = $('#ploStatus-dataTable').DataTable({
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
    });
  
    // Add event listener for edit button in ploStatus DataTable
    $('#ploStatus-dataTable tbody').on('click', 'button.ploStatus-button', function () {
      let rowData = tableploStatus.row($(this).closest('tr')).data();
      console.log('ploStatus-Table : ');
      console.log(rowData);
    });

const ploStatusdata = [
    {
        "RegistrationNumber": "123456",
        "Name": "John Doe",
          "PLO1": "Pass",
          "PLO2": "Fail",
          "PLO3": "Fail",
          "PLO4": "Pass",
          "PLO5": "Pass",
          "PLO6": "Pass",
          "PLO7": "Fail",
          "PLO8": "Pass",
          "PLO9": "Pass",
          "PLO10": "Fail",
          "PLO11": "Pass",
          "PLO12": "Pass"
      },
    {
        "RegistrationNumber": "123456",
        "Name": "John Doe",
          "PLO1": "Pass",
          "PLO2": "Fail",
          "PLO3": "Fail",
          "PLO4": "Pass",
          "PLO5": "Pass",
          "PLO6": "Pass",
          "PLO7": "Fail",
          "PLO8": "Pass",
          "PLO9": "Pass",
          "PLO10": "Fail",
          "PLO11": "Pass",
          "PLO12": "Pass"
      },
    {
        "RegistrationNumber": "123456",
        "Name": "John Doe",
          "PLO1": "Pass",
          "PLO2": "Fail",
          "PLO3": "Fail",
          "PLO4": "Pass",
          "PLO5": "Pass",
          "PLO6": "Pass",
          "PLO7": "Fail",
          "PLO8": "Pass",
          "PLO9": "Pass",
          "PLO10": "Fail",
          "PLO11": "Pass",
          "PLO12": "Pass"
      },
    {
        "RegistrationNumber": "123456",
        "Name": "John Doe",
          "PLO1": "Pass",
          "PLO2": "Fail",
          "PLO3": "Fail",
          "PLO4": "Pass",
          "PLO5": "Pass",
          "PLO6": "Pass",
          "PLO7": "Fail",
          "PLO8": "Pass",
          "PLO9": "Pass",
          "PLO10": "Fail",
          "PLO11": "Pass",
          "PLO12": "Pass"
      },
    {
        "RegistrationNumber": "123456",
        "Name": "John Doe",
          "PLO1": "Pass",
          "PLO2": "Fail",
          "PLO3": "Fail",
          "PLO4": "Pass",
          "PLO5": "Pass",
          "PLO6": "Pass",
          "PLO7": "Fail",
          "PLO8": "Pass",
          "PLO9": "Pass",
          "PLO10": "Fail",
          "PLO11": "Pass",
          "PLO12": "Pass"
      }
];
    
        // Create a Cell for checkbox
        
        ploStatusdata.forEach((object) => {
               
      tableploStatus.row.add([
        object.RegistrationNumber,
        object.Name,
        object.PLO1,
        object.PLO2,
        object.PLO3,
        object.PLO4,
        object.PLO5,
        object.PLO6,
        object.PLO7,
        object.PLO8,
        object.PLO9,
        object.PLO10,
        object.PLO11,
        object.PLO12,
          ]);
    });
  
    tableploStatus.draw();
  
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

  });
  