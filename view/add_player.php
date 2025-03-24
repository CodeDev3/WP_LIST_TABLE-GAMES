<div class="container d-flex justify-content-end mt-4">
    <a class="btn btn-primary" href="http://localhost/project/wp-admin/admin.php?page=all-player"> View Players</a>
</div>

<div class="container d-flex justify-content-center">

    <div class="card w-75 shadow-lg transparent">
        <div class="card-header text-center">
            <h2>Add Player</h2>
        </div>
        <div class="alert"></div>
        <form id="PlayerData">
            <div class="form-group m-3">
                <label for="playerName" class="m-2">Player Name</label>
                <input type="text" class="form-control" name="playerName" id="playerName" placeholder="Enter Player Name">
            </div>
            <div class="form-group m-3">
                <label for="playerEmail" class="m-2">Player Email</label>
                <input type="text" class="form-control" name="playerEmail" id="playerEmail" placeholder="Enter Player Email">
            </div>
            <div class="form-group m-3">
                <label for="playerDOB" class="m-2">Player DOB</label>
                <input type="date" class="form-control" id="playerDOB" name="playerDOB">
            </div>

            <div class="form-group m-3">
                <label for="playerGameCategory" class="m-2">Select Game</label>
                <select id="playerGameCategory" class="form-control" name="playerGame">
                    <option value="" disbaled>Select Game</option>
                    <option value="Cricket">Cricket</option>
                    <option value="Football">Football</option>
                    <option value="Hockey">Hockey</option>
                    <option value="Badminton">Badminton</option>
                </select>
            </div>
            <div class="form-group m-3">
                <label for="playerAddress" class="m-2">Player Address</label>
                <textarea class="form-control" id="playerAddress" name="playerAddress" placeholder="Enter Player Address"></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-submit">Submit</button>
            </div>
        </form>
    </div>
</div>

</div>