

$(function(){
   //define variables
   var activeNote = 0;
   var editMode = false;
   // load notes on page: load ajax call to loadnotes.php
   $.ajax({
   	url: "loadnotes.php",
   	success: function(data){
   		$('#notes').html(data);
   		clickonNote(); clickonDelete();
   	},
   	error: function(){
   		$('#alertContent').text('There was an error with the Ajax Call. Please try again');
   		$("#alert").fadeIn();
   	}
   });

   // add a new note: Ajax call to createnotes.php
   
    $('#addnote').click(function(){
        $.ajax({
            url: "createnote.php",
            success: function(data){
                if(data == 'error'){
                    $('#alertContent').text("There was an issue inserting the new note in the database!");
                    $("#alert").fadeIn();
                }else{
                    //update activeNote to the id of the new note
                    activeNote = data;
                     //console.log(activeNote);
                    $("textarea").val("");
                    //show hide elements
                    showHide(["#notepad", "#allnotes"], ["#notes", "#addnote", "#edit", "#done"]);
                    $("textarea").focus();
                    
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later 20.");
                    $("#alert").fadeIn();
            }
        
        
        });
    
    
    });

    



    //type note: : Ajax call to updatenote.php
    $("textarea").keyup(function(){
        activeNote;
        console.log("Steven Anthony");
        console.log(activeNote + " update");
        $.ajax({
            url: "updatenote.php",
            type: "POST",
            data: {note: $("textarea").val(), id: activeNote},
            success: function(data){
                console.log(data);
                if(data == "error"){
                  $('#alertContent').text('There was an issue with the Ajax Call. Please try again');
                  $("#alert").fadeIn();  
               }    
            },
            error: function(){
                $('#alertContent').text('There was an error with the Ajax Call 21. Please try again');
                $("#alert").fadeIn();
            }
        })
         
    });
    //click on all notes button

    $('#allnotes').click(function(){
       $.ajax({
    url: "loadnotes.php",
    success: function(data){
        $('#notes').html(data);
        showHide(["#addnote", "#edit", "#notes"], ["#allnotes", "#notepad"]);
        clickonNote(); clickonDelete();
    },
    error: function(){
        $('#alertContent').text('There was an error with the Ajax Call 22. Please try again');
        $("#alert").fadeIn();
    }
   });
});
    

    
    //click on done after editing: load notes again
    $("#done").click(function(){
        //siwtch to non edit mode
        editMode = false;
       //expand notes
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
        //show hide elements
        showHide(["#edit"],[this, ".delete"]);
    });
    
    
    //click on edit: go to edit mode (show delete buttons, ...)
    $("#edit").click(function(){
        //switch to edit mode
        editMode = true;
        //reduce the width of notes
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        //show hide elements
        showHide(["#done", ".delete"],[this]);
    
    });
    
    // functions
    // click on a note
        function clickonNote(){              
        $(".noteheader").click(function(){
            if(!editMode){
                //update activeNote variable to id of note
                activeNote = $(this).attr("id");

                //fill text area
                $("textarea").val($(this).find('.text').text());
                //show hide elements
                showHide(["#notepad", "#allnotes"], ["#notes", "#addnote", "#edit", "#done"]);
                $("textarea").focus();
            }
        });
    }
        //click on delete
    
    function clickonDelete(){
        $(".delete").click(function(){
            var deleteButton = $(this);
            //send ajax call to delete note
            $.ajax({
                url: "deletenote.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:deleteButton.next().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        $('#alertContent').text("There was an issue in trying to  delete the note from the database!");
                        $("#alert").fadeIn();
                    }else{
                        //remove containing div
                        deleteButton.parent().remove();
                    }
                },
                error: function(){
                    $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                            $("#alert").fadeIn();
                }

            });
            
        });
        
     }
        //show Hide function
        function showHide(array1, array2){
        for(i=0; i<array1.length; i++){
            $(array1[i]).show();   
        }
        for(i=0; i<array2.length; i++){
            $(array2[i]).hide();   
        }
    };


});//end ready function
        
    
    
  