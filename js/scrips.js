document.addEventListener('DOMContentLoaded', () => {
  const table = document.getElementById('added-departments'); // Get reference to the table element
  const data = [
    // Array of objects with the data
    {
      id: '1',
      universityName: 'University of Malakand',
      deptName: 'Software Engineering',
      email: 'khalilullah@uom.edu.pk',
      username: 'khalilullah@se.uom',
      regDate: '10-02-2023',
      licenseExpiry: '31-12-2024',
    },
    {
      id: '1',
      universityName: 'University of Mardan',
      deptName: 'Software Engineering',
      email: 'kakakhan@uet.edu.pk',
      username: 'kakakhan12@se.uom',
      regDate: '10-02-2023',
      licenseExpiry: '31-12-2024',
    },
    {
      id: '2',
      universityName: 'University of Malakand',
      deptName: 'Software Engineering',
      email: 'khalilullah@uom.edu.pk',
      username: 'khalilullah@se.uom',
      regDate: '10-02-2023',
      licenseExpiry: '31-12-2024',
    },
    {
      id: '3',
      universityName: 'University of Malakand',
      deptName: 'Software Engineering',
      email: 'khalilullah@uom.edu.pk',
      username: 'khalilullah@se.uom',
      regDate: '10-02-2023',
      licenseExpiry: '31-12-2024',
    },
    {
      id: '4',
      universityName: 'University of Malakand',
      deptName: 'Software Engineering',
      email: 'khalilullah@uom.edu.pk',
      username: 'khalilullah@se.uom',
      regDate: '10-02-2023',
      licenseExpiry: '31-12-2024',
    },
    {
      id: '5',
      universityName: 'University of Malakand',
      deptName: 'Software Engineering',
      email: 'khalilullah@uom.edu.pk',
      username: 'khalilullah@se.uom',
      regDate: '10-02-2023',
      licenseExpiry: '31-12-2024',
    },
  ];

  // Iterate through the array of objects and populate the table
  data.forEach((object, index) => {
    // Iterate through each property of the object and create cells with the values
    const row = table.insertRow(); // Create a new row
    row.classList.add('table-row');
    // Create a new cell
    const cell = row.insertCell(); 
    // Create a text node with the value
    const text = document.createTextNode(index + 1); 
    cell.appendChild(text); // Append the text node to the cell
    Object.values(object)
      .slice(1)
      .forEach((value) => {
        const cell = row.insertCell(); // Create a new cell
        const text = document.createTextNode(value); // Create a text node with the value
        cell.appendChild(text); // Append the text node to the cell
      });

    // Create a cell for the additional HTML data on the right side
    const additionalDataCell = row.insertCell(); 
    // Create a new cell
    additionalDataCell.className = 'right col-lg-1'; 
    // Set the cell's class name

    // Create a container for the buttons
    const buttonContainer = document.createElement('div');
    buttonContainer.className =
      'd-flex align-items-center justify-content-sm-between';

    // Create the Edit button
    const editButton = document.createElement('button');
    editButton.classList.add('icon-button', 'edit-button');
    editButton.innerHTML = '<img src="icons/edit.svg" alt="Edit">';

    // Add event listener to the Edit button
    editButton.addEventListener('click', () => {
      // Pass the index of the row to the event handler
      handleEditButtonClick(index); 
    });

    buttonContainer.appendChild(editButton);

    // Create the Delete button
    const deleteButton = document.createElement('button');
    deleteButton.className = 'icon-button delete-button ';
    deleteButton.innerHTML = '<img src="icons/trash.svg" alt="Delete">';

    // Add event listener to the Delete button
    deleteButton.addEventListener('click', () => {
      handleDeleteButtonClick(index); // Pass the index of the row to the event handler
    });

    buttonContainer.appendChild(deleteButton);

    additionalDataCell.appendChild(buttonContainer);
  });

  // Event handler for the Edit button click
  // function handleEditButtonClick(rowIndex) {
  //   // Access the data of the clicked row using the rowIndex
  //   const rowData = data[rowIndex];
  //   console.log('Edit button clicked for row:', rowIndex);
  //   console.log('Row data:', rowData);
  // }

  function handleEditButtonClick(rowIndex) {
    const rowData = data[rowIndex];
    console.log('Edit button clicked for row:', rowIndex);
    console.log('Row data:', rowData);
  
    // Display the modal
    const modal = document.getElementById('popUp');
    const overlay = document.querySelector('.dark-overlay');
    const cancelPopup = document.getElementById('cancelPopUpBtn');
    const closePopupIcon = document.getElementById('closeIcon');
    const modalContainerEl = document.querySelector('.modalsContainer');

    document.getElementById('AddSavePopupBtn').innerHTML = 'Save'


    popUpEl.classList.add('modal-open');
    document.body.classList.add('modal-open');
    overlay.style.display = 'block';
    modalContainerEl.style.display = "block";
    
    
  
    // Populate the input fields with the row data
    document.getElementById('university-name-input').value = rowData.universityName;
    document.getElementById('dept-name-input').value = rowData.deptName;
    document.getElementById('email-input').value = rowData.email;
    document.getElementById('username-input').value = rowData.username;
   }
  

  // Event handler for the Delete button click
  function handleDeleteButtonClick(rowIndex) {
    // Access the data of the clicked row using the rowIndex
    const rowData = data[rowIndex];
    console.log('Delete button clicked for row:', rowIndex);
    console.log('Row data:', rowData);
  }


  // Event handler for the Delete button click
// Event handler for the Delete button click
  
  // Dynimaically adding 'admin' as logedIn user.
  const userNameLinkElement = document.getElementById('user-name-link');
  const userNameTextElement = document.getElementsByClassName('user-name-text');

  userNameLinkElement.textContent = 'Admin';
  userNameTextElement[0].textContent = 'Admin';

  //Number of Total Departments
  const numberOfTotalDepartments =
    document.getElementsByClassName('total-departments');
  numberOfTotalDepartments[0].textContent = data.length;
});
