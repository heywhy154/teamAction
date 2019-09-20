<nav class="db_nav p-3 navbar-light">
    <span class="wm_user"> <?php echo "Howdy {$user_data['username']}"; ?>
    </span>
    <form method="post" class="float-right db_logout">
        <button class="btn btn-danger" type="submit" name="logout">
            Log out
        </button>
    </form>
</nav>


<div class="p-3">
    <div>
        <h5>Welcome to your Dashboard </h5>
        <div class="list-group col-sm-4">
            <div href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">Name</h6>
                </div>
                <p class="mb-1"><?php echo " {$user_data['name']}"; ?></p>
            </div>
            <div href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">Email</h6>
                </div>
                <p class="mb-1"><?php echo " {$user_data['email']}"; ?></p>
            </div>
            <div href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">Dev Stack</h6>
                </div>
                <p class="mb-1"><?php echo " {$user_data['status']}"; ?></p>
            </div>
        </div>
        <p class="mt-2">This is just a Dummy Dashboard created by the amazing TeamAction of HNGI6. More features to be added soon.</p>
    </div>
</div>