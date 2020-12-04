<form action="{{ route('message.search') }}" method="get" class="d-flex mr-3">
    <div class="form-group mb-0  ml-5">
        <input type="text" name="q" class="form-control" placeholder="Chercher un Hubb">
    </div>
    <button type="submit" class="btn "><i class="fas fa-search btnSearch"></i></button>
</form>