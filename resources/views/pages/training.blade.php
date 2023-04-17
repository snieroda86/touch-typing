@extends('layouts.app')

@section('content')

<style type="text/css">
   /* #training-input-area{
        display: none;
    }*/
</style>

<section class="bg-light py-5">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-xxl-8">
                <div class="text-center my-5" id="training-input-area">
                    <h5 class="text-center">Twoje słowo:</h5>
                    <h2 id="typed-word-sn" class="pt-4 text-center"></h2>
                    <div class="text-center pt-3" id="typing-area-input-wrap">
                        <input type="text" id="typing-user-area" autofocus>
                    </div>
                    <p class="pt-3"><span>Pozostało jeszcze:</span><span id="to-finish-count" class="pl-2"></span></p>
                    <div class="text-center pt-3 m-auto" style="max-width: 300px;">
                        <p>Ustaw liczbe powtórzeń:</p>
                        <select id="finish-count-set" class="form-control">
                            <option value="3">3</option>
                            <option selected value="5">5</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@php

$wordsArr = json_encode($words , JSON_UNESCAPED_UNICODE);

@endphp

@section('scripts-js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var wordsArr = <?php echo $wordsArr ?> ;
        randomIndex = Math.floor(Math.random() * wordsArr.length);
        var randomWord = wordsArr[randomIndex].trim();
        var randomWordLength = randomWord.length;
        var typedWordSn = document.getElementById('typed-word-sn');
        typedWordSn.innerHTML = randomWord.toUpperCase();
        var typingUserArea = document.getElementById('typing-user-area');
        typingUserArea.maxLength = randomWordLength;
        var finishCountSet = document.getElementById('finish-count-set');
        // var finishCountSetVal = finishCountSet.value;

        var toFinishCount = document.getElementById('to-finish-count'); 
        
        if(localStorage.getItem('count_end_local')){
            var toFinishCountNum = localStorage.getItem('count_end_local');
        }else{
            var toFinishCountNum = 5;
        }


        toFinishCount.innerHTML = toFinishCountNum;
        var typingValArr = [];

        finishCountSet.addEventListener('change' , function(){
            if (localStorage) {
              var finishCountSetVal = this.value;
              toFinishCountNum = finishCountSetVal;
              localStorage.setItem('count_end_local', finishCountSetVal);
              toFinishCount.innerHTML = toFinishCountNum;
            } else {
              alert('Twoja przeglądarka nie wspiera technologii wymaganej do wykonania tej akcji. Zmień przeglądarkę na najnowszą wersje Chrome');
            }
            
        });


        function letsType(e) {

          if (/^[a-zA-Z\u0100-\u02AF]$/.test(e.key) || (e.altKey && /^[\u0100-\u02AF]$/.test(e.key))) {

            var typingVal = this.value;
            var typingValLength = typingVal.length;
            var randomWordPart = randomWord.slice(0,typingValLength );

            // console.log('To jest wartośc inputa ' + typingVal +' ,a to jest częśc słowa '+ randomWordPart );

            if(typingVal.trim() === randomWordPart.trim() ){

              if(typingValLength === randomWordLength  ){
                e.preventDefault(); 
                typingUserArea.value = '';
                toFinishCountNum--;  
                toFinishCount.innerHTML = toFinishCountNum; 

                // When 10 times 
                if(toFinishCountNum === 0 ){
                    
                    toFinishCountNum = 5;
                    location.reload();
                }


              }
            }else{

              e.preventDefault();
              e.stopPropagation();
            }
          }else{
            if (e.keyCode !== 8) {
              e.preventDefault();
            }
          }
        }

        typingUserArea.addEventListener('keyup', letsType);

        // Add selected attribute
        function setSelectedValue() {
          var selectedValue = localStorage.getItem('count_end_local');
          if (selectedValue != null) {
            var selectElement = document.getElementById('finish-count-set');
            var options = selectElement.options;
            for (var i = 0; i < options.length; i++) {
              if (options[i].value == selectedValue) {
                options[i].selected = true;
                break;
              }
            }
          }
        }

        setSelectedValue();



    });

</script>
@endsection
