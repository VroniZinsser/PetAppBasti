import {API} from '@/constants';

let users = null

const userService = {
  
    /**
     * Creates a new user.
     *
     * @param {{}} user data for the user's creation
     * @return {Promise<{headers: Headers, ok: boolean, redirected: boolean, status: number, statusText: string, trailer: Promise<Headers>, type: ResponseType, url: string, clone(): Response, body: ReadableStream | null, bodyUsed: boolean, arrayBuffer(): Promise<ArrayBuffer>, blob(): Promise<Blob>, formData(): Promise<FormData>, json(): Promise<any>, text(): Promise<string>} | never>}
     */
    create(user) {
      // fill user's address fields if available
      if (user.address !== null) {
        user.country = user.address.country;
        user.state = user.address.state;
        user.city = user.address.city;
        user.postal_code = user.address.postalCode;
        user.district = user.address.district;
        user.street = user.address.street;
        user.house_number = user.address.houseNumber;
        user.address = user.address.street;
      }
      
      return fetch(`${API}usuarios/crear-profesional`, {
        method: 'POST',
        body: JSON.stringify(user),
        headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
      })
          .then(rta => rta.json())
          .then(respuesta => {
            if (respuesta.success) {
              if (Array.isArray(users)) {
                users.push(respuesta.user);
              }
            }
            return {...respuesta};
          });
    },

    /**
     * Returns necessary data for the users creation form
     *
     * @returns {Promise<any>}
     */
     createForm() {
      return fetch(`${API}usuarios/crear-profesional`)
          .then(res => res.json());
    },
  }
  export default userService;
  