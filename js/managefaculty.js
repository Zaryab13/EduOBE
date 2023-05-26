
const facultyData = [
    {
        id: 1,
        name: 'Arsalan Khan',
        gender: 'Male',
        designation: 'Lecture',
        role: 'Coordinator',
        highestDegree: 'Phd',
        pictureURL: 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80'
    },
    {
        id: 2,
        name: 'Qari Saib',
        gender: 'Male',
        designation: 'Associate Professor',
        role: 'HOD',
        highestDegree: 'post Doctorate',
        pictureURL: 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80'
    }
]



    const cardsList = document.querySelector('.faculty-cards');
    let card = document.createElement('div');
    card.classList.add('col-12','col-sm-6','col-md-4', 'col-lg-3');

    card.innerHTML = `
    <div class="faculty-card">
        <div class="picture">
            <img class="img-fluid" id="ViewProfileDetails"
                src="${facultyData[0].pictureURL}">
        </div>
        <div class="team-content">
            <h3 class="name">${facultyData[0].name}</h3>
            <h4 class="title">${facultyData[0].role}</h4>
        </div>
        <ul class="actionBtns d-flex align-items-center justify-content-evenly">
            <button class="fcEditBtn" id="facultyEditBtn">Edit</button>
            <button class="fcDltBtn">Delete</button>
        </ul>
    </div>
`;
   
cardsList.appendChild(card);