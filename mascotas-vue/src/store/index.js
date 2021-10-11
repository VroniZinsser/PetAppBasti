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
     */
    setStatus(newStatus) {
        if(this.debug) {
            console.log('Store :: setStatus con la data: ', newStatus);
        }

        this.status = {
            ...this.status,
            ...newStatus
        }
    },
};

export default store;
