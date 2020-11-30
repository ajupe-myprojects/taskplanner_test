<div>
    <div class="container pt-3">
        <div class="card">
            <div class="card-header p-2">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                
                <form action="/login" method="POST">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="email">E-Mail : *</label>
                            <input type="text" name="email" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="password">Password : *</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
                <?php if(isset($feedback)) : ?>
                    <p><?= $feedback ?>Tesrt</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>