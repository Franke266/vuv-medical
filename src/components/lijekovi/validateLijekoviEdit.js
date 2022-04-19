export default function validateInfo(values) {
    let errors = {}
    if (!values.value.trim()) {
      errors.status = 'Morate odabrati status!'
    }
    return errors
  }
  