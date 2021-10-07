import {API} from '@/constants';

let users = null

const userService = {
  
    /**
     * Crea un nuevo usuario en el servidor.
     *
     * @param {{}} data Los datos del usuario por crear.
     * @return {Promise<{headers: Headers, ok: boolean, redirected: boolean, status: number, statusText: string, trailer: Promise<Headers>, type: ResponseType, url: string, clone(): Response, body: ReadableStream | null, bodyUsed: boolean, arrayBuffer(): Promise<ArrayBuffer>, blob(): Promise<Blob>, formData(): Promise<FormData>, json(): Promise<any>, text(): Promise<string>} | never>}
     */
    create(data) {
      return fetch(`${API}/user/create`, {
        method: 'POST',
        body: JSON.stringify(data),
       // credentials: 'include'
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
  }
  export default userService;
  