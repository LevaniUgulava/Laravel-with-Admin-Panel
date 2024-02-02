<!-- resources/views/auth/verify.blade.php -->
<form action="{{url('verifyemail')}}" method="post">
    @csrf
    <label>email:</label>
    <input name="email" type="email" >
    <button>
        send
    </button>
</form>
