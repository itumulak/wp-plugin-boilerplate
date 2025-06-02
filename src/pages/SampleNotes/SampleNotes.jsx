import React, { useState } from 'react';

const SampleNotes = () => {
  const [input, setInput] = useState('');
  const [items, setItems] = useState([]);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (input.trim() === '') return;

    setItems(prev => [...prev, input.trim()]);
    setInput('');
  };

  return (
    <div style={{ maxWidth: '400px', margin: '0 auto', padding: '1rem' }}>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          value={input}
          onChange={e => setInput(e.target.value)}
          placeholder="Add notes..."
          onKeyDown={(e) => {
            if (e.key === 'Enter') handleSubmit(e);
          }}
          style={{ width: '100%', padding: '0.5rem' }}
        />
        <button type="submit" style={{ marginTop: '0.5rem' }}>
          Add to List
        </button>
      </form>

      <ul style={{ marginTop: '1rem' }}>
        {items.map((item, index) => (
          <li key={index}>{item}</li>
        ))}
      </ul>
    </div>
  );
};

export default SampleNotes;
