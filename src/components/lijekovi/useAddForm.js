import { useState } from 'react'

const useForm = (Success, props) => {
  const [values, setValues] = useState({
    oib: props.user.oib,
    vrsta: '',
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
            vrsta: values.vrsta,
            status: values.status,
            doktor: values.doktor,
          }),
        }
      
        if(values.oib!=null || values.oib!='')
        {
      fetch(
        'http://localhost/vuv-medical/API/api/lijekovi/create.php',
        requestOptions
      )
        
        .then((response) => response.json())
        .then((data) => {
          Success(data.message)
          //window.location.reload()
        })
      }
        
  }

  return { handleChange, values, handleSubmit}
}

export default useForm
