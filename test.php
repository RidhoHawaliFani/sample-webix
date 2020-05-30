<script language="javascript">
function process1() {
document.getElementById("A2").value = document.getElementById("A1").value;
}

</script>
</head>

<body>



And This Is My form code:

<form><input name="A1" type="text" class="A1" id="A1"/></form>

<form><input type="hidden" id="A2" name="A2" value="" onmouseout="process1()" /></form>