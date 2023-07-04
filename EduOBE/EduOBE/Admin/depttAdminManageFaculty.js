document.addEventListener('DOMContentLoaded', () => {
  let data = jsonDataFaculty;
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  const facultyData = [];

  data.forEach((object, index) => {
    facultyData.push(object);      
  });
  
  console.log('data: ');
  console.log(data);


  //  ==============================================================
  const addUpdateFacultyLabel = document.getElementById(
    'addUpdateFacultyLabel'
  );
  const addUpdateFacultyFromSaveBtn = document.getElementById(
    'addUpdateFacultyFromSaveBtn'
  );
  const addNewFacultyBtn = document.getElementById('addNewFacultyBtn');
  const addUpdateModelForm = document.getElementById('addUpdateModelForm');
  const empIdInput = document.getElementById("employee_id");
  //  ==============================================================
  addNewFacultyBtn.addEventListener('click', () => {
    addUpdateFacultyLabel.innerHTML = 'Add New Faculty';
    addUpdateFacultyFromSaveBtn.innerHTML = 'Add';
    addUpdateModelForm.action = `addFaculty.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

    // remove the existing data in addNewFacultyModal, for New Entry
      $('#addUpdateFaculty input[name="first_name"]').val("");
      $('#addUpdateFaculty input[name="middle_name"]').val("");
      $('#addUpdateFaculty input[name="last_name"]').val("");
      $('#addUpdateFaculty input[name="employee_id"]').val("");
      $('#addUpdateFaculty select[name="gender"]').val("");
      $('#addUpdateFaculty select[name="designation"]').val("");
      $('#addUpdateFaculty select[name="highest_degree"]').val("");
      $('#addUpdateFaculty select[name="appointment_type"]').val("");
      $('#addUpdateFaculty select[name="role"]').val("");
      $('#addUpdateFaculty input[name="dob"]').val("")
      $('#addUpdateFaculty input[name="email"]').val("");
      $('#addUpdateFaculty input[name="phone"]').val("");
      $('#addUpdateFaculty select[name="experience"]').val("");
      $('#addUpdateFaculty input[name="cnic"]').val("");
      $('#addUpdateFaculty input[name="joining_date"]').val("");
      $('#addUpdateFaculty input[name="leaving_date"]').val("");
      $('#addUpdateFaculty input[name="address"]').val("");
  });
  //  ==============================================================
  

  const handleFacultyDeleteButtonEvent = (selectedFacultyData) => {
    $(document).on('click', '#confirmDeleteFacultyBtn', () => {
    
      console.log(selectedFacultyData);
        //   // Close the modal
        // $('#deleteConfirmationModal').modal('hide');
    
        // Redirect to the PHP file 
        const url = `deleteFacultyQuery.php?Employee_id=${encodeURIComponent(selectedFacultyData.Employee_id)}&userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;
        window.location.href = url;
        
      
      });
  }

  const cardsList = document.querySelector('.faculty-cards');

  for (let i = 0; i < facultyData.length; i++) {
    const card = document.createElement('div');
    card.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3');

    card.innerHTML = `
            <div class="faculty-card">
                <div class="picture">
                    <img class="img-fluid" id="ViewProfileDetails" data-bs-toggle = "modal" data-bs-target = "#ViewFacultyInfoModal" src="${facultyData[i].pic_path}">
                </div>
                <div class="team-content">
                    <h3 class="name">${facultyData[i].first_name + " " + facultyData[i].middle_name}</h3>
                    <h3 class="name">${facultyData[i].last_name}</h3>
                    <h4 class="title">${facultyData[i].role}</h4>
                </div>
                <ul class="actionBtns d-flex align-items-center justify-content-evenly">
                    <button class="fcEditBtn" id="facultyEditBtn" data-bs-toggle="modal" data-bs-target="#addUpdateFaculty">Edit</button>
                    <button class="fcDltBtn" data-bs-toggle="modal" data-bs-target="#deleteFacultyConfirmationModal">Delete</button>
                </ul>
            </div>
        `;

    // Get the delete button element from the dynamically created card
    const deleteBtn = card.querySelector('.fcDltBtn');

    // Add event listener to the delete button
    deleteBtn.addEventListener('click', () => {
      // openFacultyDltModal();
      // You can access the specific faculty item using facultyData[i]
      var modal = new bootstrap.Modal(
        document.getElementById('deleteFacultyConfirmationModal')
      );
      modal.show();
      handleFacultyDeleteButtonEvent(facultyData[i]);
      console.log('Delete button clicked for:', facultyData[i]);
    });

    cardsList.appendChild(card);

    const ViewInfo = document.getElementById('ViewProfileDetails');
    ViewInfo.addEventListener('click', () => {

      console.log('Image CLicke');
    //   card.setAttribute('data-bs-toggle','modal');
    //   card.setAttribute('data-bs-target','#ViewFacultyInfoModal');


    });
  }
  // Get the images that opens the faculty info modal
  var facultyImages = document.querySelectorAll('#ViewProfileDetails');
  facultyImages.forEach(function (btn) {
    btn.addEventListener('click', function () {
      
      
        console.log('clicked............');
        console.log(btn);
      // Show the modal when the button is clicked
      var modal = new bootstrap.Modal(
        document.getElementById('ViewFacultyInfoModal')
      );
      modal.show();

      

      // Get the index of the clicked faculty card
      var index = Array.from(facultyImages).indexOf(btn);

      // 
      document.getElementById('faclty_image').setAttribute('src', facultyData[index].pic_path);
      document.getElementById('faclty_name').innerHTML =  facultyData[index].first_name + " " + facultyData[index].middle_name + " " + facultyData[index].last_name;
      document.getElementById('faclty_empId').innerHTML =  facultyData[index].Employee_id;
      document.getElementById('faclty_gender').innerHTML =  facultyData[index].gender;
      document.getElementById('faclty_designation').innerHTML =  facultyData[index].Designation;
      document.getElementById('faclty_highestDegree').innerHTML =  facultyData[index].highest_degree;
      document.getElementById('faclty_appointmentType').innerHTML =  facultyData[index].appointment_type;
      document.getElementById('faclty_role').innerHTML =  facultyData[index].role;
      document.getElementById('faclty_DOB').innerHTML =  facultyData[index].DOB;
      document.getElementById('faclty_email').innerHTML =  facultyData[index].email;
      document.getElementById('faclty_phone').innerHTML =  facultyData[index].phone;
      document.getElementById('faclty_exp').innerHTML =  facultyData[index].experience;
      document.getElementById('faclty_cnic').innerHTML =  facultyData[index].cnic;
      document.getElementById('faclty_joiningDate').innerHTML =  facultyData[index].joining_date;
      document.getElementById('faclty_leavingDate').innerHTML =  facultyData[index].leaving_date;
      document.getElementById('faclty_address').innerHTML =  facultyData[index].address;
      
      console.log('display faculty info image clicked for:', facultyData[index]);
    });
  });

  document
    .getElementById('ViewFacultyInfoModal')
    .addEventListener('hidden.bs.modal', function () {
      document.body.style.overflow = 'auto';

      var modal = bootstrap.Modal.getInstance(
        document.getElementById('ViewFacultyInfoModal')
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


  // Get the button that opens the Edit modal
  var editBtns = document.querySelectorAll('.fcEditBtn');

  // Loop through each button and attach a click event listener
  editBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      
      addUpdateModelForm.action = `updateFaculty.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}`;

      // Show the modal when the button is clicked
      var modal = new bootstrap.Modal(
        document.getElementById('addUpdateFaculty')
      );
      modal.show();

      addUpdateFacultyLabel.innerHTML = 'Update Existing Faculty';
      addUpdateFacultyFromSaveBtn.innerHTML = 'Update';

      // Get the index of the clicked faculty card
      var index = Array.from(editBtns).indexOf(btn);

      // 
      $('#addUpdateFaculty input[name="first_name"]').val(facultyData[index].first_name);
      $('#addUpdateFaculty input[name="middle_name"]').val(facultyData[index].middle_name);
      $('#addUpdateFaculty input[name="last_name"]').val(facultyData[index].last_name);
      $('#addUpdateFaculty input[name="employee_id"]').val(facultyData[index].Employee_id);
      $('#addUpdateFaculty select[name="gender"]').val(facultyData[index].gender);
      $('#addUpdateFaculty select[name="designation"]').val(facultyData[index].Designation);
      $('#addUpdateFaculty select[name="highest_degree"]').val(facultyData[index].highest_degree);
      $('#addUpdateFaculty select[name="appointment_type"]').val(facultyData[index].appointment_type);
      $('#addUpdateFaculty select[name="role"]').val(facultyData[index].role);
      $('#addUpdateFaculty input[name="dob"]').val(facultyData[index].DOB);
      $('#addUpdateFaculty input[name="email"]').val(facultyData[index].Email);
      $('#addUpdateFaculty input[name="phone"]').val(facultyData[index].phone);
      $('#addUpdateFaculty select[name="experience"]').val(facultyData[index].experience);
      $('#addUpdateFaculty input[name="cnic"]').val(facultyData[index].cnic);
      $('#addUpdateFaculty input[name="joining_date"]').val(facultyData[index].joining_date);
      $('#addUpdateFaculty input[name="leaving_date"]').val(facultyData[index].leaving_date);
      $('#addUpdateFaculty input[name="address"]').val(facultyData[index].address);
      
      console.log('Edit button clicked for:', facultyData[index]);
      console.log('something')
    });
  });

  //delete all entry of modal.show() for faculty update button
  document
    .getElementById('addUpdateFaculty')
    .addEventListener('hidden.bs.modal', function () {
      document.body.style.overflow = 'auto';
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

  //delete all entry of modal.show() for faculty delete button
  document
    .getElementById('deleteFacultyConfirmationModal')
    .addEventListener('hidden.bs.modal', function () {
      document.body.style.overflow = 'auto';
      var modal = bootstrap.Modal.getInstance(
        document.getElementById('deleteFacultyConfirmationModal')
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
