<style>

.full {
  width: 100%;
  float: left;
  padding: 1em;
}

.half {
  width: 50%;
  float: left;
  padding: 1em;
}

.third {
  width: 33.3%;
  float: left;
  padding: 1em;
}
    form.partner {
  padding: 4em 20%;
  width: 80%;
  margin: 0 auto;
}
@media (max-width: 960px) {
  form.partner {
    width: 100%;
    padding: 2em 10%;
  }
}

h2.heading {
  font-size: 18px;
  text-transform: uppercase;
  font-weight: 300;
  text-align: left;
  color: #45ae72;
  border-bottom: 1px dashed #80d4a4;
  padding: 1em;
  margin-bottom: 20px;
}

.controls {
  text-align: left;
  position: relative;
}
.controls input[type="text"],
.controls input[type="email"],
.controls input[type="tel"],
.controls textarea,
.controls button,
.controls select {
  padding: 12px;
  font-size: 14px;
  border: 2px solid #808184;
  width: 100%;
  color: #888;
  font-family: 'Lato', 'sans-serif';
  font-size: 16px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  -moz-transition: all 0.2s;
  -o-transition: all 0.2s;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}
.controls input[type="text"]:focus, .controls input[type="text"]:hover,
.controls input[type="email"]:focus,
.controls input[type="email"]:hover,
.controls input[type="tel"]:focus,
.controls input[type="tel"]:hover,
.controls textarea:focus,
.controls textarea:hover,
.controls button:focus,
.controls button:hover,
.controls select:focus,
.controls select:hover {
  outline: none;
  border-color: #45ae72;
  background: #e9fff2;
}
.controls input[type="text"]:focus + label, .controls input[type="text"]:hover + label,
.controls input[type="email"]:focus + label,
.controls input[type="email"]:hover + label,
.controls input[type="tel"]:focus + label,
.controls input[type="tel"]:hover + label,
.controls textarea:focus + label,
.controls textarea:hover + label,
.controls button:focus + label,
.controls button:hover + label,
.controls select:focus + label,
.controls select:hover + label {
  color: #45ae72;
  cursor: text;
}
.controls select {
  -moz-appearance: none;
  -webkit-appearance: none;
  cursor: pointer;
}
.controls label {
  position: absolute;
  left: 20px;
  top: 28px;
  color: #999;
  font-size: 16px;
  display: inline-block;
  padding: 4px 10px;
  font-weight: 700;
  transition: color 0.3s, top 0.2s, font-size 0.2s;
}
.controls label.active {
  top: -10px;
  left: 16px;
  color: #555;
  font-style: oblique;
  font-size: 0.8em;
}
.controls textarea {
  resize: none;
  height: 200px;
}
.controls button {
  cursor: pointer;
  background-color: #46A8E3;
  border: none;
  color: #fff;
  padding: 12px 0;
  margin: 1em 0;
}
.controls button:hover {
  background-color: #7dc2eb;
}
</style>
<form action="" class="partner">
    <h2>Become a partner with us.</h2>
<p>Host your own online course platform for your school. Please fill in the form below.</p>
  <!--  General -->
  <div class="form-group">
    <h2 class="heading full">Personal Info</h2>
    <div class="controls half">
      <input type="text" id="firstName" class="floatLabel" name="First Name" required>
      <label for="firstName">First Name</label>
    </div>
    <div class="controls half">
      <input type="text" id="lastName" class="floatLabel" name="Last Name" required>
      <label for="lastName">Last Name</label>
    </div>
    <div class="controls full">
      <input type="email" id="email" class="floatLabel" name="email" required>
      <label for="email">Email</label>
    </div>
  </div>
  <!--  Details -->
  <div class="form-group">
    <h2 class="heading full">School/Organization</h2>
    <div class="controls full">
      <input type="tel" id="cell" class="floatLabel" name="cell">
      <label for="cell">name</label>
    </div>
    <div class="controls full">
      <select class="floatLabel">
          <option value="blank" selected></option>
        <option value="gh">Ghana</option>
      </select>
      <label for="fruit">Country</label>
    </div>
  </div>
  <!--  More -->
  <div class="form-group">
    <h2 class="heading full">Additional info</h2>
    <div class="controls full">
      <textarea name="comments" class="floatLabel" id="comments"></textarea>
      <label for="comments">Message</label>
      <button class="full">Submit</button>
    </div>
  </div>
</form>
<div style="clear:both"></div>

<script>
    // Added input value check on postback/load, removed floatLabel class from select input. Modified the scss, added color map.

(function($){
    function floatLabel(inputType){
        $(inputType).each(function(){
            var $this = $(this);
            var text_value = $(this).val();

            // on focus add class "active" to label
            $this.focus(function(){
                $this.next().addClass("active");
            });

            // on blur check field and remove class if needed
            $this.blur(function(){
                if($this.val() === '' || $this.val() === 'blank'){
                    $this.next().removeClass();
                    }
            });
                    
            // Check input values on postback and add class "active" if value exists
            if(text_value!=''){
                $this.next().addClass("active");
                }
            });
    
        // Automatically remove floatLabel class from select input on load
        $( "select" ).next().removeClass();
    }
    // Add a class of "floatLabel" to the input field
    floatLabel(".floatLabel");
})(jQuery);
</script>