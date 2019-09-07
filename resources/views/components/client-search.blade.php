<div class='inline-form'>
    <form method="POST" action="/clients/search">
        @csrf
        @if ($errors->has('emptyCheck')) <p class='error'>Enter critera to search...</p> @endif
        <input class='fluffy-input' type='text' value="{{old('First_Name')}}" id='First_Name' name='First_Name' placeholder="First Name">
        <p class='shy'>and/or</p>
        <input class='fluffy-input' type='text' value="{{old('Last_Name')}}" id='Last_Name' name='Last_Name' placeholder="Last Name">
        <p class='shy'>and/or</p>
        <input class='fluffy-input' type='text' value="{{old('Phone_Number')}}" id='Phone_Number' name='Phone_Number' placeholder="Phone Number">
        <input type='submit' value="Search" class='fluffy-button'>
    </form>

    <script>
        function clear(element) {
            element.classList.remove('invalid')
        }
    </script>
    @if ($errors->has('First_Name'))
        @if(isset($bottomMessages)) <p style='color:orangered;'><font face="Helvetica"><b>First name can only include letters. Example: Matthew</font></b></p> @endif
        <script>
            var fname = document.getElementById('First_Name')
            fname.classList.add('invalid')
            fname.addEventListener('input', function(f) {
                clear(fname)
            })
        </script>
    @endif
    @if ($errors->has('Last_Name'))
        @if(isset($bottomMessages)) <p style='color:orangered;'><font face="Helvetica"><b>Last name can only include letters. Example: Smith</font></b></p> @endif
        <script>
            var lname = document.getElementById('Last_Name')
            lname.classList.add('invalid')
            lname.addEventListener('input', function(f) {
                clear(lname)
            })
        </script>
    @endif
    @if ($errors->has('Phone_Number'))
        @if(isset($bottomMessages)) <p style='color:orangered;'><font face="Helvetica"><b>Phone number must include exactly 10 numeric digits. Example: (417)865-4545</font></b></p> @endif
        <script>
            var phone = document.getElementById('Phone_Number')
            phone.classList.add('invalid')
            phone.addEventListener('input', function(f) {
                clear(phone)
            })
        </script>
    @endif
</div>