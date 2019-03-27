<html>

<head>
<meta charset="UTF-8">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="style.css">

</head>

<body>
<div>
<input type="text" class="add" id="textName" /> 
<input type="date" class="add" id="textDate" /> 
<select id="famille" class="btn bleu">

</select>
<input type="button" class="btn vert" value="add" id="add" />
<br>
<table border=1 >
<tr>
    <th>numero</th>
    <th>date</th>
    <th>task</th>
    <th>prenom</th>
    <th>actions</th>
</tr>
<tbody id="zone">
</tbody >
</table>
</div>

<script src="index.js"></script>
</body>
</html>