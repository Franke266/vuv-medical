import { useState } from 'react'

const useForm = (Success, props) => {
  const [values, setValues] = useState({
    doktor: props.user.doktor,
    pacijent: props.user.oib,
    tekst: '',
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
            doktor: values.doktor,
            pacijent: values.pacijent,
            tekst: values.tekst,
          }),
        }
      

      fetch(
        'http://localhost/vuv-medical/API/api/poruke/create.php',
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
