$(document).ready(function(){
    
    var feedback = "";
    $("#btnSurvey").click(function(event) {
        
        event.preventDefault();
        
        //Get answers
        var answer2 = $("input[name='question2']:checked").val();
        
        //console.log(answer2);
        
        //Checks the checked answer
        // Question 2
        if(answer2 === "Yes") {
            yesAnswer($("#question2-feedback"));
        } else if (answer2 === "No") {
            noAnswer($("#question2-feedback"));
        } else if (answer2 === "Unsure") {
            unsureAnswer($("#question2-feedback"));
        }
        
        $("#question2-feedback").append(" -Thank you for the feedback." );

        //Displays Question feedback 
        $("#feedback").html( feedback );
        $("input[type='submit']").css("display", "none");

        //Submits and stores score, retrieves average score
        $.ajax({
            type : "post",
            url  : "submitSurvey.php",            
            dataType : "json",
            data : {"feedback" : feedback},            
            success : function(data){
                console.log(data);
                $("#feedback").css("display","block");
                $("input[type='submit']").css("display","");
            },
            complete: function(data,status) { //optional, used for debugging purposes
               // alert(status);
            }

        });//AJAX
        
    }); //formSubmit
    
    //Styles a question as answered yes
    function yesAnswer(questionFeedback){
        questionFeedback.html("Yes ");
        questionFeedback.addClass("correct");
        questionFeedback.removeClass("incorrect");
        feedback = "Yes";
    }

    //Styles a question as answered no
    function noAnswer(questionFeedback){
        questionFeedback.html("No ");
        questionFeedback.addClass("incorrect");
        questionFeedback.removeClass("correct");
        feedback = "No"
    }
    
    //Styles a question as answered unsure
    function unsureAnswer(questionFeedback){
        questionFeedback.html("Unsure ");
        questionFeedback.addClass("incorrect");
        questionFeedback.removeClass("correct");
        feedback = "Unsure"
    }
    
    
}); //documentReady   
