import express from 'express';
import cors from 'cors';

// importar conexion a la base de datos
import db from './database/db.js';
import UsaRoute from './routes/routes.js';

const app = express()

app.use(cors())
app.use(express.json())
app.use('/usuario', UsaRoute)


try {
   await db.authenticate
   console.log('conexion exitosa a la DB')
} catch (error) {
    console.log('conexion fallida a la DB')
}


app.get('/',(req,res)=>{
    res.send('perro')
})

app.listen(8000, ()=>{
    console.log('Server up running in http://localhost:8000/')
})