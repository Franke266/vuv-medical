import { useState } from 'react'

const useForm = (id, Success ) => {
  const [values, setValues] = useState({
    oib: '',
    ime: '',
    prezime: '',
    specijalist: '',
    opis: '',
    status: '',
    doktor: '',
  })
  const [errors, setErrors] = useState({})

  const handleChange = (e) => {
    const { name, value} = e.target
    setValues({
      ...values,
      [name]: value,
    })
  }
  
  const handleSubmit = (e) => {
    e.preventDefault()
    //var error = validate(values)
    

    let requestOptions = {}
        requestOptions = {
          method: 'PUT',
          headers: { 'Content-Type': 'aplication/json' },
          body: JSON.stringify({
            id: id,
            oib: values.oib,
            ime: values.ime,
            prezime: values.prezime,
            specijalist: values.specijalist,
            opis: values.opis,
            status: values.status,
            doktor: values.doktor,
          }),
        }

      fetch(
        'http://localhost/vuv-medical/API/api/uputnice/update.php',
        requestOptions
      )
        .then((response) => response.json())
        .then((data) => {
          Success(data.message)
          //window.location.reload()
        })
        //.catch((error) => {
         // console.log(
           // 'There has been a problem with your fetch operation:',
           // error
         // )
       // })
    
  }

  return { handleChange, values, handleSubmit}
}

export default useForm
