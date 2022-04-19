import { useState } from 'react'

const useForm = (Success, props) => {
  const [values, setValues] = useState({
    oib: props.user.oib,
    razlog: '',
    opis: '',
    termin: '',
    status: 'Na čekanju',
    doktor: props.user.doktor,
  })
  //const [errors, setErrors] = useState({})

  const handleChange = (e) => {
    const { name, value } = e.target
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
          method: 'POST',
          headers: { 'Content-Type': 'text/plain' },
          body: JSON.stringify({
            oib: values.oib,
            razlog: values.razlog,
            opis: values.opis,
            termin: values.termin,
            status: values.status,
            doktor: values.doktor,
          }),
        }
      

      fetch(
        'http://localhost/vuv-medical/API/api/pregledi/create.php',
        requestOptions
      )
        .then((response) => response.json())
        .then((data) => {
          Success(data.message)
          //window.location.reload()
        })
        
  }

  return { handleChange, values, handleSubmit}
}

export default useForm
