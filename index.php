<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/star-wars" rel="stylesheet">
                
    <title>Chat with Grandmaster Yoda</title>
</head>
<body>
    <h1>Yoda Chat</h1>
    <p class="instruction">You can speak with Yoda here! Let Yoda guide you.</p>
    <div class="output">
        <p cass="message1"></p>
    </div>
        <form name="chatForm">
            <label for="chatbox"></label>
            <textarea id="chatbox" name="chatbox" rows="10" cols="80"></textarea>
            <input id="submit_btn" type="submit" value="Send">
        </form>

    <script>
        window.onload = function(){ //Everytime the form is submitted, it causes the page to reload which calls the function.
            var formHandle = document.forms.chatForm;   //Gets the form
            console.log(formHandle);
    
            formHandle.onsubmit = processForm; //When the form is submitted, the processForm function is called.

            function processForm(){
                var chatBoxValue = formHandle.chatbox; //gets the chatbox textarea 
        

                var node=document.createElement("p"); //creates a p element
                node.setAttribute("class", "user_input");
                var textnode = document.createTextNode(chatBoxValue.value); //creates a text node and places the user input of the chatbox area in it.
                node.appendChild(textnode); //appends this textnode to the p element created
                document.getElementsByClassName("output")[0].appendChild(node); //appends the node (p element) as a child to the "output" div

                var node2=document.createElement("p"); //creates a 2nd p element
                node2.setAttribute("class","yoda_response");
                console.log(node2);
                
              

                fetch('api_request.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                  },
                  body: 'user_input=' + encodeURIComponent(chatBoxValue.value)
                })
                .then(response => response.text())
                .then(data => node2.innerHTML = data);
                document.getElementsByClassName("output")[0].appendChild(node2);


                chatBoxValue.value=""; //clears the chatbox input field after a message is sent;

                window.scrollTo(0, document.body.scrollHeight);
                
                return false;
            }

            var input = document.getElementById("chatbox")
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("submit_btn").click();
                }
            });
        }
    </script>

    
</body>
</html>