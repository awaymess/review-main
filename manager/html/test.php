<!DOCTYPE html>
<html>
    <head>
        <title>Add New Option</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
      
        <select id="select">
            <option value="java">Java</option>
            <option value="c#">C#</option>
        </select>
        <input type="text" id="val">
        <button onclick="insertValue();">Add</button>

        <script>
            
            function insertValue()
            {
                var select = document.getElementById("select"),
                    txtVal = document.getElementById("val").value,
                    newOption = document.createElement("OPTION"),
                    newOptionVal = document.createTextNode(txtVal);
             
                newOption.appendChild(newOptionVal);
                select.insertBefore(newOption,select.firstChild);
            }
            
        </script>

    </body>
</html>
