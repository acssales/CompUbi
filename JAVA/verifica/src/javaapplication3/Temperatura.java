package javaapplication3;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;
import javax.xml.bind.annotation.XmlRootElement;

@Entity
@Table(name = "temperatura")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Temperatura.findAll", query = "SELECT t FROM Temperatura t")
    , @NamedQuery(name = "Temperatura.findById", query = "SELECT t FROM Temperatura t WHERE t.id = :id")
    , @NamedQuery(name = "Temperatura.findByLocaliza", query = "SELECT t FROM Temperatura t WHERE t.localiza = :localiza")
    , @NamedQuery(name = "Temperatura.findByTemperatura", query = "SELECT t FROM Temperatura t WHERE t.temperatura = :temperatura")
    , @NamedQuery(name = "Temperatura.findByState", query = "SELECT t FROM Temperatura t WHERE t.state = :state")
    , @NamedQuery(name = "Temperatura.findByDataSensor", query = "SELECT t FROM Temperatura t WHERE t.dataSensor = :dataSensor")})
public class Temperatura implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "id")
    private Integer id;
    @Column(name = "localiza")
    private String localiza;
    @Basic(optional = false)
    @Column(name = "temperatura")
    private int temperatura;
    @Column(name = "state")
    private String state;
    @Basic(optional = false)
    @Column(name = "data_sensor")
    @Temporal(TemporalType.TIMESTAMP)
    private Date dataSensor;

    public Temperatura() {
    }

    public Temperatura(Integer id) {
        this.id = id;
    }

    public Temperatura(Integer id, int temperatura, Date dataSensor) {
        this.id = id;
        this.temperatura = temperatura;
        this.dataSensor = dataSensor;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getLocaliza() {
        return localiza;
    }

    public void setLocaliza(String localiza) {
        this.localiza = localiza;
    }

    public int getTemperatura() {
        return temperatura;
    }

    public void setTemperatura(int temperatura) {
        this.temperatura = temperatura;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public Date getDataSensor() {
        return dataSensor;
    }

    public void setDataSensor(Date dataSensor) {
        this.dataSensor = dataSensor;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (id != null ? id.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Temperatura)) {
            return false;
        }
        Temperatura other = (Temperatura) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "javaapplication3.Temperatura[ id=" + id + " ]";
    }
    
}
