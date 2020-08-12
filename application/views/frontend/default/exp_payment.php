<?php
	$order_id = $this->input->get("order-id");
	$token = $this->input->get("token");
?>
<style>

.loader{
  width: 100px;
  height: 100px;
  border-radius: 100%;
  position: relative;
  margin: 0 auto;
}

#loader-1:before, #loader-1:after{
  content: "";
  position: absolute;
  top: -10px;
  left: -10px;
  width: 100%;
  height: 100%;
  border-radius: 100%;
  border: 10px solid transparent;
  border-top-color: #3498db;
}

#loader-1:before{
  z-index: 100;
  animation: spin 1s infinite;
}

#loader-1:after{
  border: 10px solid #ccc;
}

@keyframes spin{
  0%{
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100%{
    -webkit-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

.content{
	display: flex;
	align-items: center;
	justify-content: center;
	height: 100%;
	width: 100%;
	flex-direction: column;
}

#button{
	border-radius: 5px;
	outline: none;
	border: solid 1px #4cbb17;
	background-color: #4cbb17;
	color: white;
	font-weight: bolder;
	text-transform: uppercase;
	padding: 20px;
	cursor: pointer;
}

#button:disabled{
	background: lightgrey;
	border: none;
	color: grey;
	cursor: not-allowed;
}

</style>
<div class="content">
    <div class="loader" id="loader-1"></div>
    <p id="status">Waiting for confirmation</p>
    <p><small id="description">If you used mobile money, please follow the instructions from the prompt on your phone</small></p>
    <button id="button" disabled="disabled">Continue</button>
</div>

<script>
	fetch("<?php echo site_url('home/exp_payment?order-id='.$order_id.'&token='.$token.'&ret=true'); ?>")
	.then(res => res.json())
	.then(result => handleData(result));

	function handleData(data){
		console.log(data)
		if(data.result == 1){
			showSuccess();
		}
		else{
			if(data.result == 4){
				setInterval(()=>{fetch("<?php echo site_url('home/exp_payment?order-id='.$order_id.'&token='.$token.'&ret=true');?>")
	.then(res => res.json())
	.then(result => handleData(result))},5000);
			}
			else{
				showFailure(data['result-text'])
			}
		}
	}

	function showSuccess(){
		document.getElementById("status").innerText = "Payment successfull";
		document.getElementById("description").innerText = "Click the button below to continue.";
		document.getElementById("button").removeAttribute("disabled");
		document.getElementById("button").innerText = "Go to my courses"
	}

	function showFailure(message){
		document.getElementById("status").innerText = "Payment failed";
		document.getElementById("description").innerText = message + "<br>Click below to go to your cart and try again.";
		document.getElementById("button").removeAttribute("disabled");
		document.getElementById("button").innerText = "Try again";
	}
	document.getElementById("button").onclick = function(){window.location.replace("<?php echo site_url('home/exp_payment?order-id='.$order_id.'&token='.$token);?>")}
</script>