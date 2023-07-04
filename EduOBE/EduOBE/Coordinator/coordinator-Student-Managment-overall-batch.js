document.addEventListener('DOMContentLoaded', () => {
  var username = userNameJsonData;
  var uni_logo = uniLogoJsonData;
  var deptt_logo = depttLogoJsonData;

  var data = jsonData;
  const allBatches = [];
  // console.log('data:',data);
  

  data.forEach((object, index) => {
    allBatches.push(object);      
  });


  const generateBatchCard = (batch) => {
    let cardElement = document.createElement('div');
    cardElement.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3');

    let batchCardElement = document.createElement('div');
    batchCardElement.classList.add('batch-card');

    let batchNameElement = document.createElement('h3');
    batchNameElement.textContent = batch.name;

    let programElement = document.createElement('p');
    programElement.textContent = batch.program;

    let studentCountElement = document.createElement('div');
    studentCountElement.classList.add('no-students');
    let studentCountSpan = document.createElement('span');
    studentCountSpan.textContent = batch.num_of_std;
    studentCountElement.appendChild(studentCountSpan);

    batchCardElement.appendChild(batchNameElement);
    batchCardElement.appendChild(programElement);
    batchCardElement.appendChild(studentCountElement);

    cardElement.appendChild(batchCardElement);

    // Event listener for click event on the batch card
    cardElement.addEventListener('click', () => {
      // Store the clicked batch data in local storage
      localStorage.setItem('clickedBatch', JSON.stringify(batch));

      // Navigate to batch-student-list page.
      window.location.href =
        `coordinator-Student-Managment-batch-students-list.php?userName=${username}&uniLogo=${uni_logo}&depttLogo=${deptt_logo}&batchName=${batch.name}`;
    });

    return cardElement;
  };

  let batchCardsElement = document.getElementById('batch-cards');

  allBatches.forEach((batch) => {
    let batchCard = generateBatchCard(batch);
    batchCardsElement.appendChild(batchCard);
  });
});
