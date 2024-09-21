const questionElement = document.getElementById("question");
const answerBtns = document.getElementById("answerBtns");
const nextBtn = document.getElementById("nextBtn");

let questionIndis = 0;
let score = 0;
let temp = [];

function startQuiz(){
    questionIndis = 0;
    score = 0;
    nextBtn.innerHTML = "İleri";
    //null kontrol yapmazsam localde soru yokken yeni inen proje hata veriyor
    temp = JSON.parse(localStorage.getItem('questions'));
    if (!temp) {
        allQuestions = [];
    }
    showQuestion();
}

function showQuestion(){
    reset();    
    if (temp.length === 0) {
        showScore();
        return;
    }
    
    questionIndis = Math.floor(Math.random() * temp.length);
    let currentQuestion = temp[questionIndis];
    let questionNum = score + 1;
    questionElement.innerHTML = questionNum + ". " + currentQuestion.question;

    currentQuestion.answers.forEach(answer => {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("ansBtn");
        answerBtns.appendChild(button);
        if(answer.correct){
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    });
    temp.splice(questionIndis, 1);
}

function reset(){
    nextBtn.style.display = "none";
    while(answerBtns.firstChild){
        answerBtns.removeChild(answerBtns.firstChild);
    }
}

function selectAnswer(e){
    const selectBtn = e.target;
    const isCorrect = selectBtn.dataset.correct === "true";
    if(isCorrect){
        selectBtn.classList.add("true");
        score++;
    } else {
        selectBtn.classList.add("false");
    }
    Array.from(answerBtns.children).forEach(button => {
        if(button.dataset.correct === "true"){
            button.classList.add("true");
        }
        button.disabled = true;
    });
    nextBtn.style.display = "block";
}

function showScore(){
    reset();
    questionElement.innerHTML = `Puanınız: ${score} / ${JSON.parse(localStorage.getItem('questions')).length}!`;
    nextBtn.innerHTML = "Ana Sayfa";
    nextBtn.style.display = "block";
}

nextBtn.addEventListener("click", ()=>{
    if (nextBtn.innerHTML === "Ana Sayfa") {
        window.location.href = "home.html";
    } else {
        showQuestion();
    }
});

startQuiz();
