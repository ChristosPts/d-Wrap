<script>
        document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('catOption');
        if (localStorage['catOption']) { // if job is set
            input.value = localStorage['catOption']; // set the value
        }
        input.onchange = function () {
                localStorage['catOption'] = this.value; // change localStorage on change
            }
        });
    </script>   
 
<select name="catOption" id = "catOption">
   <option value="...">Categories</option>          

   <option value="Animals">Animals</option>
   <option value="Autumn">Autumn</option>

   <option value="City">City</option>
   <option value="Cyberpunk">Cyberpunk</option>
   
   <option value="Fantasy">Fantasy</option>
   <option value="Food">Food</option>
   <option value="Forest">Forest</option>
   <option value="Fashion">Fashion</option>

   <option value="Spring">Spring</option>
   <option value="Summer">Summer</option>
                  
   <option value="Sea">Sea</option>
   <option value="Space">Space</option>
   <option value="Vehicles">Vehicles</option>
   <option value="Vintage">Vintage</option>
   <option value="Winter">Winter</option>
</select> 