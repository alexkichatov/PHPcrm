<form class="form-horizontal" method="post" data-ng-show="isShowEditForm" data-ng-submit="updateUserData()">
    <input type="hidden" data-ng-model="userId">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="fullName">ФИО</label>
            <div class="col-md-4">
                <input id="fullName" name="fullName" data-ng-model="userFullName" class="form-control input-md" required="true" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="address">Адрес</label>
            <div class="col-md-4">
                <input id="address" name="address" data-ng-model="userAddress" class="form-control input-md" required="true" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Телефон</label>
            <div class="col-md-4">
                <input id="login" name="phone" data-ng-model="userPhone" class="form-control input-md" required="true" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>
            <div class="col-md-4">
                <input id="email" name="email" data-ng-model="userEmail" class="form-control input-md" required="true" type="email">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-default">Сохранить</button>
                <button class="btn btn-danger" type="button" data-ng-click="deleteUser(userId)">Удалить</button>
            </div>
        </div>
    </fieldset>
</form>