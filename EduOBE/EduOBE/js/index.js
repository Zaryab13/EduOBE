let menu = document.querySelectorAll('.menu');

menu.forEach((menu) =>
  menu.addEventListener('click', () => {
    menu.classList.toggle('active');
  })
);

let arrow = document.querySelectorAll('.arrow');
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener('click', (e) => {
    let arrowParent = e.target.parentElement.parentElement;
    //selecting main parent of arrow
    arrowParent.classList.toggle('showMenu');
  });
}

let sidebar = document.querySelector('.sidebar');
let sidebarBtn = document.querySelector('.bx-menu');
sidebarBtn.addEventListener('click', () => {
  sidebar.classList.toggle('close');
});

const editEl = document.getElementById('editIcon');
const deleteEl = document.getElementById('deleteIcon');
const nameInputEl = document.querySelector("input[name = 'fullName']");
const empIdInputEl = document.querySelector("input[name = 'employeeId']");
const depInputEl = document.querySelector("input[name = 'Department']");
const posInputEl = document.querySelector("input[name = 'position']");
const responsibilitiesInputEl = document.querySelector(
  "input[name = 'position']"
);
const endorsInputEl = document.querySelector("input[name = 'position']");

const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return [...document.querySelectorAll(el)];
  } else {
    return document.querySelector(el);
  }
};

// Easy event listener function

const on = (type, el, listener, all = false) => {
  let selectEl = select(el, all);
  if (selectEl) {
    if (all) {
      selectEl.forEach((e) => e.addEventListener(type, listener));
    } else {
      selectEl.addEventListener(type, listener);
    }
  }
};
// On scroll Event Listener

const onscroll = (el, listener) => {
  el.addEventListener('scroll', listener);
};
// To open profile drop down on click

const dropDownBtn = document.querySelector('.dropBtn');
const subMenu = document.getElementById('profileSubMenu');

dropDownBtn.addEventListener('click', () => {
  subMenu.classList.toggle('open');
  dropDownBtn.classList.toggle('clicked');
});

// ==========================================
// Open Close Notification Drop down on click
// ==========================================

const notifDropDownBtn = document.querySelector('.notifdropBtn');
const notifSubMenu = document.getElementById('notifSubMenu');

notifDropDownBtn.addEventListener('click', () => {
  console.log('clicked');
  notifSubMenu.classList.toggle('open');
  notifDropDownBtn.classList.toggle('clicked');
});

// ==========================================
// Start Edit Modal Opening and Closing of Admin ui Profile Page
// ==========================================

const editButtonUniEl = document.querySelector('.editbtnUniInfo');
const editModalContainerEl = document.querySelector('.editProfModalContainer');
const editModalEl = document.getElementById('editUniInfoModal');
const editModalCloseBtnEl = document.getElementById('editUniInfoCloseBtn');
const UniModalSaveBtnEl = document.getElementById('editModalSaveBtn');

editButtonUniEl.addEventListener('click', () => {
  openEditUniInfoModal();
});

editModalCloseBtnEl.addEventListener('click', () => {
  // console.log('click');
  closeEditUniInfoModal();
});

function openEditUniInfoModal() {
  editModalEl.classList.add('modal-open');
  document.body.classList.add('modal-open');
  overlay.style.display = 'block';
  editModalContainerEl.style.display = 'block';
}

function closeEditUniInfoModal() {
  console.log('clicke ');
  editModalEl.classList.remove('modal-open');
  document.body.classList.remove('modal-open');
  overlay.style.display = 'none';
  editModalContainerEl.style.display = 'none';
}

// ==========================================
// Edit Uni Info Modal Opener
// ==========================================

const editButtonDeptEl = document.querySelector('.editbtnDeptInfo');
const editDeptContainerEl = document.querySelector('.editDeptModalContainer');
const editDeptModalEl = document.getElementById('editDeptInfoModal');
const editDeptModalCloseBtnEl = document.getElementById('editDeptInfoCloseBtn');
const deptModalSaveBtnEl = document.getElementById('deptModalSaveBtn');

if (editDeptContainerEl) {
  editButtonDeptEl.addEventListener('click', () => {
    openEditDeptInfoModal();
  });

  editDeptModalCloseBtnEl.addEventListener('click', () => {
    closeEditDeptInfoModal();
  });
}

function openEditDeptInfoModal() {
  editDeptModalEl.classList.add('modal-open');
  document.body.classList.add('modal-open');
  overlay.style.display = 'block';
  editDeptContainerEl.style.display = 'block';
}

function closeEditDeptInfoModal() {
  editDeptModalEl.classList.remove('modal-open');
  document.body.classList.remove('modal-open');
  overlay.style.display = 'none';
  editDeptContainerEl.style.display = 'none';
}
