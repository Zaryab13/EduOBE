$(document).ready(function () {
  $('#uniInfoAddEditFormSaveBtn').click(function () {
    var updateButton = $(this);
    var cancelButton = $('.cancel-button');

    // Disable the cancel button
    cancelButton.prop('disabled', true);

    // Hide the button and show the progress indicator
    updateButton.hide();
    $('#uniProgressIndicator').removeClass('d-none');

    // Get the form data
    var formData = $('#uniInfoAddEditform').serialize();

    var url = 'updateUniInfoQuery.php?' + formData;

    // Add a delay before redirecting
    setTimeout(function () {
      // Redirect the browser to "updateUniInfoQuery.php" with form data as query parameters
      window.location.href = url;
    }, 2000); // Adjust the delay as needed (in milliseconds)
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const facultyData = [
    {
      id: 1,
      name: 'Arsalan Khan',
      gender: 'Male',
      designation: 'Lecture',
      role: 'Coordinator',
      highestDegree: 'Phd',
      pictureURL:
        'https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80',
    },
    {
      id: 2,
      name: 'Qari Saib',
      gender: 'Male',
      designation: 'Associate Professor',
      role: 'HOD',
      highestDegree: 'post Doctorate',
      pictureURL:
        'https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80',
    },
    {
      id: 3,
      name: 'Qari Saib',
      gender: 'Male',
      designation: 'Associate Professor',
      role: 'HOD',
      highestDegree: 'post Doctorate',
      pictureURL:
        'https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80',
    },
  ];

  //  ==============================================================
  const addUpdateFacultyLabel = document.getElementById(
    'addUpdateFacultyLabel'
  );
  const addUpdateFacultyFromSaveBtn = document.getElementById(
    'addUpdateFacultyFromSaveBtn'
  );
  const addNewFacultyBtn = document.getElementById('addNewFacultyBtn');
  //  ==============================================================
  addNewFacultyBtn.addEventListener('click', () => {
    addUpdateFacultyLabel.innerHTML = 'Add New Faculty';
    addUpdateFacultyFromSaveBtn.innerHTML = 'Add';
  });
  //  ==============================================================

  const overlay = document.querySelector('.dark-overlay');
  const dltModalContainerEl = document.querySelector(
    '.dltFacultyModalContainer'
  );
  const dltFacultyModalEl = document.getElementById('dltFacultyModal');
  const cancelBtnEl = document.getElementById('dltFacultyCancelBtn');

  if (dltModalContainerEl) {
    cancelBtnEl.addEventListener('click', () => {
      closeFacultyDltModal();
    });
  }

  function openFacultyDltModal() {
    dltFacultyModalEl.classList.add('modal-open');
    document.body.classList.add('modal-open');
    overlay.style.display = 'block';
    dltModalContainerEl.style.display = 'block';
  }

  function closeFacultyDltModal() {
    dltFacultyModalEl.classList.remove('modal-open');
    document.body.classList.remove('modal-open');
    overlay.style.display = 'none';
    dltModalContainerEl.style.display = 'none';
  }

  const cardsList = document.querySelector('.faculty-cards');

  for (let i = 0; i < facultyData.length; i++) {
    const card = document.createElement('div');
    card.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3');

    card.innerHTML = `
            <div class="faculty-card">
                <div class="picture">
                    <img class="img-fluid" id="ViewProfileDetails" src="${facultyData[i].pictureURL}">
                </div>
                <div class="team-content">
                    <h3 class="name">${facultyData[i].name}</h3>
                    <h4 class="title">${facultyData[i].role}</h4>
                </div>
                <ul class="actionBtns d-flex align-items-center justify-content-evenly">
                    <button class="fcEditBtn" id="facultyEditBtn" data-bs-toggle="modal" data-bs-target="#addUpdateFaculty">Edit</button>
                    <button class="fcDltBtn">Delete</button>
                </ul>
            </div>
        `;

    // Get the delete button element from the dynamically created card
    const deleteBtn = card.querySelector('.fcDltBtn');

    // Add event listener to the delete button
    deleteBtn.addEventListener('click', () => {
      openFacultyDltModal();
      // You can access the specific faculty item using facultyData[i]
      console.log('Delete button clicked for:', facultyData[i]);
    });

    cardsList.appendChild(card);
  }
  // Get the button that opens the modal
  var btns = document.querySelectorAll('.fcEditBtn');

  // Loop through each button and attach a click event listener
  btns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      //   console.log('clicked............');
      //   console.log(btn);
      // Show the modal when the button is clicked
      var modal = new bootstrap.Modal(
        document.getElementById('addUpdateFaculty')
      );
      modal.show();

      addUpdateFacultyLabel.innerHTML = 'Update Existing Faculty';
      addUpdateFacultyFromSaveBtn.innerHTML = 'Update';

      // Get the index of the clicked faculty card
      var index = Array.from(btns).indexOf(btn);

      // Log the data of the clicked faculty card to the console
      console.log('Edit button clicked for:', facultyData[index]);
    });
  });

  document
    .getElementById('addUpdateFaculty')
    .addEventListener('hidden.bs.modal', function () {
      var modal = bootstrap.Modal.getInstance(
        document.getElementById('addUpdateFaculty')
      );
      if (modal) {
        modal.dispose();
      }

      // Remove the overlay
      var overlay = document.querySelector('.modal-backdrop');
      if (overlay) {
        overlay.parentNode.removeChild(overlay);
      }
    });
});
