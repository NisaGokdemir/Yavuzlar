
// Yönlendirmeler

function questListPage(){
    window.location.href ="questList.html";
}

function editQuestPage(){
    window.location.href ="editQuest.html";
}

function addQuestPage(){
    window.location.href = "addQuest.html";
}

function backQuestPage() {  
    window.location.href = "questList.html";  
}

function backHomePage(){
    window.location.href = "home.html";
}

function editQuestPage(indis) {
    localStorage.setItem('editIndis', indis);
    window.location.href = "editQuest.html";
}

function startPage(){
    window.location.href = "quizapp.html";
}


// CRUD İşlemleri

function getQuestions() {
    const questionsContainer = document.querySelector('.questions');
    let allQuestions = JSON.parse(localStorage.getItem('questions'));
    //null kontrol yapmazsam localde soru yokken yeni inen proje hata veriyor
    if (!allQuestions) {
        allQuestions = [];
    } 
    // Soruları sıfırlamazsam sil butonuna basılınca sanki hala ekliyor gibi davranıyor
    questionsContainer.innerHTML = '';
    allQuestions.forEach((question, indis) => {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'question';
        // indis değerini yollamazsam hangi soruyu güncellemem gerektiğini veya silmem gerektiğini anlayamam, react axios ile url den veri yollamak gibi
        questionDiv.innerHTML = `
            <span>${question.question}</span>
            <div>
                <button class="btn editPage" onClick="editQuestPage(${indis})">Düzenle</button>
                <button class="btn delete" onClick="deleteQuestion(${indis})">Sil</button>
            </div>
        `;
        questionsContainer.appendChild(questionDiv);
    });
}

function deleteQuestion(indis) {
    let allQuestions = JSON.parse(localStorage.getItem('questions')); 
    //indisten itibaren 1 elemanı sil, filter ve map yeniden dizi oluşturuyor onlar react da yeni dizi döndürerek state tetikliyordu
    allQuestions.splice(indis, 1);
    localStorage.setItem('questions', JSON.stringify(allQuestions));
    alert("Soru silindi");
    console.log(allQuestions);
    getQuestions();
}

function addQuestion() {    
    const quest = document.getElementById('quest').value;  
    const answerValue = document.getElementById('answer').value;  
    const difficulty = document.getElementById('difficulty').value;  
    const answer1Value = document.getElementById('answer1').value;
    const answer2Value = document.getElementById('answer2').value;
    const answer3Value = document.getElementById('answer3').value;
    const answer4Value = document.getElementById('answer4').value;
    const answers = [
        { text: answer1Value, correct: answerValue === "1" },
        { text: answer2Value, correct: answerValue === "2" },
        { text: answer3Value, correct: answerValue === "3" },
        { text: answer4Value, correct: answerValue === "4" }
    ];      
    const addedQuestion = {  
        question: quest,  
        answers: answers,   
        difficulty: difficulty  
    };  
    let allQuestions = JSON.parse(localStorage.getItem('questions'));  
    if (!allQuestions) {
        allQuestions = [];
    }
    allQuestions.push(addedQuestion);  
    localStorage.setItem('questions', JSON.stringify(allQuestions));   
    console.log(allQuestions);  
    alert("Soru Eklendi");
}

function formEditQuestion() {
    const indis = localStorage.getItem('editIndis');
    let allQuestions = JSON.parse(localStorage.getItem('questions'));
    if (!allQuestions) {
        allQuestions = [];
    }
    const editQuestion = allQuestions[indis];
    document.getElementById('quest').value = editQuestion.question;
    document.getElementById('answer1').value = editQuestion.answers[0].text;
    document.getElementById('answer2').value = editQuestion.answers[1].text;
    document.getElementById('answer3').value = editQuestion.answers[2].text;
    document.getElementById('answer4').value = editQuestion.answers[3].text;
    document.getElementById('difficulty').value = editQuestion.difficulty;
    //doğru yanlış cevabı nasıl çekeceğimi anlayamadım geri döneceğim 
}

function editQuestion() {
    const indis = localStorage.getItem('editIndis');
    let allQuestions = JSON.parse(localStorage.getItem('questions'));
    if (!allQuestions) {
        allQuestions = [];
    }
    const quest = document.getElementById('quest').value; 
    const answerValue = document.getElementById('answer').value; 
    const difficulty = document.getElementById('difficulty').value; 
    const answer1Value = document.getElementById('answer1').value;
    const answer2Value = document.getElementById('answer2').value;
    const answer3Value = document.getElementById('answer3').value;
    const answer4Value = document.getElementById('answer4').value;
    allQuestions[indis].question = quest;
    allQuestions[indis].answers = [
            { text: answer1Value, correct: answerValue === "1" },
            { text: answer2Value, correct: answerValue === "2" },
            { text: answer3Value, correct: answerValue === "3" },
            { text: answer4Value, correct: answerValue === "4" }
        ];
        allQuestions[indis].difficulty = difficulty;
        localStorage.setItem('questions', JSON.stringify(allQuestions));   
        console.log(allQuestions);
        alert("Soru Düzenlendi");
}

function searchQuestion() {
    const searchInput = document.querySelector('.searchInput').value;
    const questionsContainer = document.querySelector('.questions');
    let allQuestions = JSON.parse(localStorage.getItem('questions'));
    if (!allQuestions) {
        allQuestions = [];
    }
    const filteredQuestions = allQuestions.filter(question => 
        question.question.includes(searchInput)
    );
    //soruları sıfırlamazsam başta hepsini getquestion ile getirdiğim için saçmalıyor
    questionsContainer.innerHTML = '';
    filteredQuestions.forEach((question, indis) => {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'question';
        questionDiv.innerHTML = `
            <span>${question.question}</span>
            <div>
                <button class="btn editPage" onClick="editQuestPage(${indis})">Düzenle</button>
                <button class="btn delete" onClick="deleteQuestion(${indis})">Sil</button>
            </div>
        `;
        questionsContainer.appendChild(questionDiv);
    });
}

