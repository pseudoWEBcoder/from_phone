<?php
/*этот не доделал т к нашел нормальный там 
https://otvet.mail.ru/answer/1963265182
https://jsbin.com/vixecokike/edit?js,output
* /
?>
<!DOCTYPE html>
	<html>
		<head>
			<script src="https://code.jquery.com/jquery-3.5.1.min.js">
			</script>
			<meta charset="utf-8">
				<meta name="viewport" content="width=device-width">
					<title>JS Bin
					</title>
				</head>
				<body>
					<input name="str" type="text" />
					<input name="result" disabled="disabled"/>
					<ul></ul>
				</body>
					<script>
					var str=$('[name="str"]'), res=$('[name="result"]');
					//console.log(str)
					j =jQuery(document).on('change',str, function (event,el){
					val = str.val();
					try{
					r= eval (s='result=('+val+');');
					//console.log(s);alert(s);
					res.val(result)
					}
					catch(e){
					console.error(s)
					res.val(e["message"])
					}
					
					
					})
					arr=[];ul=jQuery ('ul');
					jQuery .each(['+','-','/','*'],(i,v)=>{arr.push(rnd(0,100)+''+v+''+rnd(0,100))}) ;
			jQuery.each(arr, function (i,v){
			li= $('<li>')	a= $('<a>')
			a.text(v)
			li.append(a)
			ul.append(li)
			})
				
						function rnd(min, max) { // случайное число от min до (max+1) let rand = min + Math.random() * (max + 1 - min); return Math.floor(rand);
						//alert(j)
					</script>
				</html>
					
						</html>