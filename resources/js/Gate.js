export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isSuperAdmin() {
        return this.user.role === 'SuperAdmin';
    }

    isUser1() {
        return this.user.role === 'User1';
    }

    isUser2() {
        return this.user.role === 'User2';
    }

    isSuperAdminOrUser2() {
        if(this.user.role === 'SuperAdmin' || this.user.role === 'User2') {
            return true;
        }
    }
}