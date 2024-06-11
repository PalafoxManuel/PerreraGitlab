import axios from 'axios'
import {useState} from 'react'
import {useNavigate} from 'react-router-dom'

const URI = 'http://localhost:8000/cliente'
const URIU = 'http://localhost:8000/usuario'

const createCliente = () => {
    const [Nombre_Completo, setNombre_completo] = useState('')
    const [Numero_Contacto, setNumero_Contacto] = useState('')
    const [Correo_Electronico, setCorreo_Electronico] = useState('')
    const [Calle, setCalle] = useState('')
    const [Codigo_Postal, setCodigo_postal] = useState('')

    const navigate = useNavigate()

    // Procedimiento para guardar el cliente
    const storeClient = async (e) => {
        e.preventDefault()
        await axios.post(URI,{
            Nombre_Completo: Nombre_Completo, 
            Numero_Contacto: Numero_Contacto,
            Correo_Electronico: Correo_Electronico,
            Calle: Calle,
            Codigo_Postal: Codigo_Postal
        })
    }

    const [nombreUsuario, setNombreUsuario] = useState('')
    const [contraseña, setContraseña] = useState('')

    // Función para crear usuario
    const storeUser = async (e) => {
        e.preventDefault()
        await axios.post(URIU,{
            nombreUsuario: nombreUsuario,
            contraseña: contraseña
        })
    }

    return (
        <div> </div>
    )
}

export default createCliente