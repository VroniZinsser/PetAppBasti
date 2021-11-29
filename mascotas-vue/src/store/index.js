const store = {
    debug: false,
    status: {
        msg: null,
        type: 'success',
        title: null
    },
    user: {
        id: null,
        email: null,
        first_name: null,
        last_name: null,
        image: null
    },
    /**
     * Actualiza el status del store.
     *
     * @param {{}} newStatus
     * @param {string} newStatus.msg
     * @param {string | null} newStatus.type
     * @param {string | null} newStatus.title
     */
    setStatus(newStatus) {
        if (this.debug) {
            // debugger;
            console.log('Store :: setStatus con la data: ', newStatus);
        }

        this.status = {
            ...this.status,
            ...newStatus
        }
    },
    /**
     * Update the store user
     *
     * @param {{}} authUser
     * @param {int} authUser.id
     * @param {string} authUser.email
     * @param {string} authUser.first_name
     * @param {string} authUser.last_name
     * @param {{} | null} authUser.image
     */
    setUser(authUser) {
        if (this.debug) {
            // debugger;
            console.log('Store :: setUser con la data: ', authUser);
        }

        this.user = {
            id: authUser.id,
            email: authUser.email,
            first_name: authUser.first_name,
            last_name: authUser.last_name,
            image: authUser.image,
        }
    },

    /**
     * Returns the user of the store to its default value.
     */
    removeUser() {
        if (this.debug) {
            // debugger;
            console.log('Store :: removeUser');
        }

        this.user = {
            id: null,
            email: null,
            first_name: null,
            last_name: null,
            image: null
        }
    }
};

export default store;
