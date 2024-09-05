const questionElement = document.getElementById("question");  
const answerBtns = document.getElementById("answerBtns");  
const nextBtn = document.getElementById("nextBtn");  

let questions = [];  
let currentQuestionIndex = 0;  
let score = 0;  

function startQuiz() {  
    fetchQuestions();  
}  

function fetchQuestions() {  
    fetch('quizappQuery.php')  
        .then(response => response.json())  
        .then(data => {  
            if (data.error) {  
                alert(data.error);  
                return;  
            }  
            questions = data;  
            showQuestion();  
        });  
}  

function showQuestion() {  
    reset();  
    if(questions.length == 0) {
        reset(); 
        questionElement.innerHTML = "Çözülecek test şimdilik bulunmamaktadır.";
        nextBtn.innerHTML = "Ana Sayfa";  
        nextBtn.style.display = "block"; 
    }
    else if (currentQuestionIndex >= questions.length) {  
        showScore();  
        return;  
    }  

    let currentQuestion = questions[currentQuestionIndex];  
    questionElement.innerHTML = `${currentQuestionIndex + 1}. ${currentQuestion.question_text}`;  

    const choices = [  
        { text: currentQuestion.choice_a, value: 'choice_a' },  
        { text: currentQuestion.choice_b, value: 'choice_b' },  
        { text: currentQuestion.choice_c, value: 'choice_c' },  
        { text: currentQuestion.choice_d, value: 'choice_d' }  
    ];  

    choices.forEach(choice => {  
        const button = document.createElement("button");  
        button.innerHTML = choice.text;  
        button.value = choice.value; 
        button.classList.add("ansBtn");  
        answerBtns.appendChild(button);  
        //e parametresi olmadan hata veriyor, cevaba göre css class ı eklemek için e kullanıyoruz o yüzden butona e yi vermeliyiz.
        button.addEventListener("click", (e) => selectAnswer(currentQuestion.correct_choice, button.value, e)); 
    });  
}  

function reset() {  
    nextBtn.style.display = "none";  
    while (answerBtns.firstChild) {  
        answerBtns.removeChild(answerBtns.firstChild);  
    }  
}  

function selectAnswer(correctChoice, userAnswer,e) {  
    const selectBtn = e.target;
    const isCorrect = (userAnswer === correctChoice);  
    if (isCorrect) {  
        score++;  
        selectBtn.classList.add("true"); 
    } else {
        selectBtn.classList.add("false");
    }
    // Kullanıcının cevabını sunucuya göndermek için js URL parametrelerini işlemek için kullanılan URLSearchParams nesnesini kullandım
    //json_decode(file_get_contents('php://input'), true) gibi başka yöntemlerde varmış, geri dönünce araştır
    const postData = new URLSearchParams();
    postData.append('questionId', questions[currentQuestionIndex].id);
    postData.append('userAnswer', userAnswer);
    fetch('quizappQuery.php', {  
        method: 'POST',  
        body: postData
    });  
    currentQuestionIndex++;  
    nextBtn.style.display = "block";  
    
    console.log("Doğru Cevap:", correctChoice);  
    console.log("Kullanıcının Cevabı:", userAnswer);  
}  
  
function showScore() {  
    reset();  
    questionElement.innerHTML = `Puan: ${score} / ${questions.length}!`;  
    nextBtn.innerHTML = "Ana Sayfa";  
    nextBtn.style.display = "block";  
}  

nextBtn.addEventListener("click", () => {  
    if (nextBtn.innerHTML === "Ana Sayfa") {  
        window.location.href = "home.php"; 
    } else {  
        showQuestion();  
    }  
});  

startQuiz();