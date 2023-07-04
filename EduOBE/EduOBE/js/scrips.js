document.addEventListener('DOMContentLoaded', () => {
  const table = document.getElementById('added-departments'); // Get reference to the table element

  let data = jsonData;

  const addUserEl = document.getElementById('addUserBtn');
  const overlay = document.querySelector('.dark-overlay');
  const popUpEl = document.getElementById('popUp');
  const closePopupIcon = document.getElementById('closeIcon');
  const popUpform = document.getElementById('inputForm');
  const popUpInputEls = document.querySelectorAll('#inputForm input');
  const modalContainerEl = document.querySelector('.modalsContainer');

  const addAdminModalConfirmButton = document.getElementById(
    'addAdminModalConfirmButton'
  );
  const addDepttModalTitle = document.getElementById('addDepttModalTitle');

  function openPopup() {
    popUpEl.classList.add('modal-open');
    document.body.classList.add('modal-open');
    overlay.style.display = 'block';
    modalContainerEl.style.display = 'block';
  }

  function closePopup() {
    popUpEl.classList.remove('modal-open');
    document.body.classList.remove('modal-open');
    overlay.style.display = 'none';
    modalContainerEl.style.display = 'none';
  }

  if (addUserEl) {
    addUserEl.addEventListener('click', () => {
      popUpInputEls.forEach((popUpInputEl) => {
        popUpInputEl.value = '';
      });
      console.log('Add User');
      openPopup();
      popUpform.action = 'createAdminQuery.php';
      addDepttModalTitle.innerHTML = 'Register Department';
      addAdminModalConfirmButton.innerHTML = 'ADD';
    });
  }

  if (closePopupIcon) {
    closePopupIcon.addEventListener('click', closePopup);
  }

  // Iterate through the array of objects and populate the table

  data.forEach((object, index) => {
    // Iterate through each property of the object and create cells with the values
    let flag = {};
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
        flag = {...flag, value:text};
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
      // Pass the index of the row to theconsol event handler
      console.log('clicked');
      handleEditButtonClick(index);
    });

    buttonContainer.appendChild(editButton);

    // Create the Delete button
    const deleteButton = document.createElement('button');
    deleteButton.className = 'icon-button delete-button';
    deleteButton.innerHTML = '<img src="icons/trash.svg" alt="Delete">';
    deleteButton.setAttribute('data-bs-toggle', 'modal');
    deleteButton.setAttribute('data-bs-target', '#deleteConfirmationModal');

    // Add event listener to the Delete button
    deleteButton.addEventListener('click', () => {
      // Pass the index of the row to the handleDeleteButtonClick event handler
      handleDeleteButtonClick(index);
    });

    buttonContainer.appendChild(deleteButton);

    additionalDataCell.appendChild(buttonContainer);
      
      
  });

  function handleEditButtonClick(rowIndex) {
    const rowData = data[rowIndex];
    console.log('Edit button clicked for row:', rowIndex);
    console.log('Row data:', rowData);

    popUpEl.classList.add('modal-open');
    document.body.classList.add('modal-open');
    overlay.style.display = 'block';
    modalContainerEl.style.display = 'block';

    addDepttModalTitle.innerHTML = 'Update Department';
    addAdminModalConfirmButton.innerHTML = 'UPDATE';
    popUpform.action = 'updateAdminQuery.php';

    document.getElementById('university-name-input').value =
      rowData.university_name;
    document.getElementById('dept-name-input').value = rowData.department_name;
    document.getElementById('email-input').value = rowData.Email;
    document.getElementById('username-input').value = rowData.user_name;
  }



function handleDeleteButtonClick(rowIndex) {
  // Access the data of the clicked row using the rowIndex
  console.log("delete button function: " + rowIndex);
  const rowData = data[rowIndex];

  // Listen for the click event on the confirm delete button
  $(document).on('click', '#confirmDeleteButton', () => {
    
  //   // Close the modal
  // $('#deleteConfirmationModal').modal('hide');

    // Redirect to the PHP file with the data as URL parameters
    const url = `deleteAdminQuery.php?userName=${encodeURIComponent(rowData.user_name)}`;
    window.location.href = url;
    
    // // Perform the AJAX request to the PHP file
    // $.ajax({
    //   type: 'POST',
    //   url: 'deleteAdminQuery.php', // Replace with the actual path to your PHP file
    //   data: {
    //     // Provide any data you want to send to the PHP file
    //     userName: rowData.user_name,
    //     // Example: departmentId: 123
    //   },
    //   success: function (response) {
    //     // Handle the success response from the PHP file
    //     console.log('Delete request successful');
    //     // You can perform any additional actions here, such as reloading the page or updating the UI

    //     // Close the modal
    //     $('#deleteConfirmationModal').modal('hide');
    //   },
    //   error: function (xhr, status, error) {
    //     // Handle the error response
    //     console.error('Error:', error);
    //   },
    // });
  });
}

  

  // Dynimaically adding 'admin' as logedIn user.
  const userNameLinkElement = document.getElementById('user-name-link');
  const userNameTextElement = document.getElementsByClassName('user-name-text');

  userNameLinkElement.textContent = 'SuperAdmin';
  userNameTextElement[0].textContent = 'SuperAdmin';

  //Number of Total Departments
  const numberOfTotalDepartments =
    document.getElementsByClassName('total-departments');
  numberOfTotalDepartments[0].textContent = data.length;
});
