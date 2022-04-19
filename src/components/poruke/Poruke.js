import React, { useState, useEffect } from 'react'
import { makeStyles } from '@material-ui/core/styles'
import IconButton from '@material-ui/core/IconButton'
import Table from '@material-ui/core/Table'
import TableBody from '@material-ui/core/TableBody'
import TableCell from '@material-ui/core/TableCell'
import TableContainer from '@material-ui/core/TableContainer'
import TableHead from '@material-ui/core/TableHead'
import TableRow from '@material-ui/core/TableRow'
import Paper from '@material-ui/core/Paper'
import { Link } from 'react-router-dom'
import ReplyIcon from '@mui/icons-material/Reply';
import Button from '@material-ui/core/Button'

const useStyles = makeStyles({
    table: {
      minWidth: 650,
      maxWidth: 1000,
      marginTop: 60,
      marginLeft: 'auto',
      marginRight: 'auto',
    },
  })
  const url =
    'http://localhost/vuv-medical/API/api/poruke/read.php'
  const Poruke = (props) => {
    const [poruke, setPoruke] = useState([])
    const getPoruke = async () => {
      const res = await fetch(url)
      const poruke = await res.json()
      setPoruke(poruke)
      console.log(poruke)
    }
  
    useEffect(() => {
      getPoruke()
    }, [])
  
    const classes = useStyles()

    return (
        <>
        <Link to={'/poruke/dodaj'}>
        <Button
                    id='submitButton'
                    type='submit'
                    variant='contained'
                    color='primary'
                    className='input'
                  >
                    Nova poruka
        </Button>
        </Link>
          <TableContainer className={classes.table} component={Paper}>
            <Table aria-label='simple table'>
              <TableHead>
                <TableRow>
                  <TableCell>Rbr.</TableCell>
                  <TableCell align='right'>Ime</TableCell>
                  <TableCell align='right'>Prezime</TableCell>
                  <TableCell align='right'>Tekst</TableCell>
                  <TableCell align='right'>Odgovori</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {poruke.map((row, index) => (
                  <TableRow key={row.id}>
                    {props.user.oib === row.doktor ? (
                      <>
                    <TableCell component='th' scope='row'>
                      {index+1}
                    </TableCell>
                    <TableCell align='right'>{row.imep}</TableCell>
                    <TableCell align='right'>{row.prezimep}</TableCell>
                    <TableCell align='right'>{row.tekst}</TableCell>
                    <TableCell>
                      <Link to={'/poruke/odgovori/id/' + row.id}>
                        <IconButton collor='primary'>
                          <ReplyIcon />
                        </IconButton>
                      </Link>
                    </TableCell>
                    </>
                    ) :(
                      ''
                      )}
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        </>
      )
    }
    

export default Poruke;